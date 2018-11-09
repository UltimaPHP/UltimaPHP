<?php
include 'uopreader.class.php';
include 'hash2lite.php';

class UOPConverter {
    public static function fromUOP($inFile, $outFile, $outFileIdx, $type, $typeIndex) {
        if (!is_file($inFile)) {
            return;
        }

        $chunkIds  = [];
        $chunkIds2 = [];

        $formatsTmp = self::getHashFormat($type, $typeIndex);
        $maxId      = $formatsTmp->maxId;
        //$maxId = 100;
        $formats = $formatsTmp->address;

        for ($i = 0; $i < $maxId; ++$i) {
            $chunkIds[hashLittle2(self::getAddress($formats[0], $i))] = $i;
        }

        if ($formats[1] != "") {
            for ($i = 0; $i < $maxId; ++$i) {
                $chunkIds2[hashLittle2(self::getAddress($formats[1], $i))] = $i;
            }
        }

        $used   = array();
        $reader = new UOPReader($inFile);

        if ($reader->readInt32() != 0x50594D) {
            // MYP
            throw new ArgumentException("inFile is not a UOP file.");
        }

        $writer = fopen($outFile, "wb");
        if ($outFileIdx == null) {
            $writerIdx = tmpfile();
        } else {
            $writerIdx = fopen($outFileIdx, "wb");
        }
        $stream = $reader->fileHolder;

        $version = $reader->readInt32();
        $reader->readInt32(); // format timestamp? 0xFD23EC43
        $nextTable = $reader->readInt64();

        do {
            // Table header
            fseek($stream, $nextTable, SEEK_SET);
            $entries   = $reader->readInt32();
            $nextTable = $reader->readInt64();

            // Table entries
            $offsets = array();

            for ($i = 0; $i < $entries; ++$i) {
                /*
                 * Empty entries are read too, because they do not always indicate the
                 * end of the table. (Example: 7.0.26.4+ Fel/Tram maps)
                 */
                $offsets[$i]                     = new TableEntry();
                $offsets[$i]->m_Offset           = $reader->readInt64();
                $offsets[$i]->m_HeaderLength     = $reader->readInt32(); // header length
                $offsets[$i]->m_Size             = $reader->readInt32(); // compressed size
                $offsets[$i]->m_SizeDecompressed = $reader->readInt32(); // decompressed size
                $offsets[$i]->m_Identifier       = $reader->readUInt64(); // filename hash (hashLittle2)
                $offsets[$i]->m_Hash             = $reader->readUInt32(); // data hash (Adler32)
                $offsets[$i]->m_Compression      = $reader->readInt16(); // compression method (0 = none, 1 = zlib)
            }

            // Copy chunks
            for ($i = 0; $i < count($offsets); ++$i) {
                if ($offsets[$i]->m_Offset == 0) {
                    continue; // skip empty entry
                }

                if (($type == FileType::MultiMUL) && ($offsets[$i]->m_Identifier == 0x126D1E99DDEDEE0A)) {
                    // MultiCollection.uop has the file "build/multicollection/housing.bin", which has to be treated separately
                    $writerBin = fopen("housing.bin", "wb");
                    fseek($stream, $offsets[$i]->m_Offset + $offsets[$i]->m_HeaderLength, SEEK_SET);
                    $binData = $reader->readBytes($offsets[$i]->m_Size);
                    $binDataToWrite;

                    if ($offsets[$i]->m_Compression == 1) {
                        $binDataToWrite = zlib_decode($binData, $offsets[$i]->m_SizeDecompressed);
                    } else {
                        $binDataToWrite = $binData;
                    }

                    fwrite($writerBin, $binDataToWrite);
                    unset($$writerBin);
                    continue;
                }

                $chunkID = -1;
                if (array_key_exists($offsets[$i]->m_Identifier, $chunkIds)) {
                    $chunkID = $chunkIds[$offsets[$i]->m_Identifier];
                } else {
                    if (array_key_exists($offsets[$i]->m_Identifier, $chunkIds2)) {
                        $chunkID = $chunkIds2[$offsets[$i]->m_Identifier];
                    } else {
                        var_dump($chunkIds);
                        unset($reader);
                        unset($writer);
                        unset($writerIdx);
                        throw new Exception("Unknown identifier encountered (" . $offsets[$i]->m_Identifier . ")");
                    }
                }

                fseek($stream, $offsets[$i]->m_Offset + $offsets[$i]->m_HeaderLength, SEEK_SET);
                $chunkDataRaw = $reader->readBytes($offsets[$i]->m_Size);

                if ($offsets[$i]->m_Compression == 1) {
                    $chunkData = zlib_decode($chunkDataRaw, $offsets[$i]->m_SizeDecompressed);
                } else {
                    $chunkData = $chunkDataRaw;
                }

                if ($type == FileType::MapLegacyMUL) {
                    // Write this chunk on the right position (no IDX file to point to it)
                    fseek($writer, $chunkID * 0xC4000, SEEK_SET);
                    fwrite($writer, $chunkData);
                } else {
                    $dataOffset = 0;

                    //#region Idx
                    fseek($writerIdx, $chunkID * 12, SEEK_SET);
                    fwrite($writerIdx, intval(ftell($writer))); // Position

                    switch ($type) {
                    case FileType::GumpartLegacyMUL:
                        {
                            // Width and height are prepended to the data
                            $width  = (ord($chunkData[0]) | (ord($chunkData[1]) << 8) | (ord($chunkData[2]) << 16) | (ord($chunkData[3]) << 24));
                            $height = (ord($chunkData[4]) | (ord($chunkData[5]) << 8) | (ord($chunkData[6]) << 16) | (ord($chunkData[7]) << 24));

                            fwrite($writerIdx, strlen($chunkData) - 8);
                            fwrite($writerIdx, ($width << 16) | $height);
                            $dataOffset = 8;
                            break;
                        }
                    case FileType::SoundLegacyMUL:
                        {
                            // Extra contains the ID of this sound file + 1
                            fwrite($writerIdx, strlen($chunkData));
                            fwrite($writerIdx, $chunkID + 1);
                            break;
                        }
                    default:
                        {
                            fwrite($writerIdx, strlen($chunkData)); // Size
                            fwrite($writerIdx, 0); // Extra
                            break;
                        }
                    }

                    $used[$chunkID] = true;
                    //#endregion

                    fseek($writer, $dataOffset, SEEK_CUR);
                    fwrite($writer, $chunkData, strlen($chunkData)); // - $dataOffset);
                }
            }

            // Move to next table
            if ($nextTable != 0) {
                fseek($stream, $nextTable, SEEK_SET);
            }
        } while ($nextTable != 0);

        // Fix idx
        // TODO: Only go until the last used entry? Does the client mind?
        if ($writerIdx != null) {
            for ($i = 0; $i < count($used); ++$i) {
                if (!isset($used[$i])) {
                    fseek($writerIdx, $i * 12, SEEK_SET);
                    fwrite($writerIdx, -1);
                    fwrite($writerIdx, (float) 0); //(long)0);
                }
            }
        }

        unset($reader);
        unset($writer);
        unset($writerIdx);
    }

    public static function getHashFormat($type, $typeIndex) {
        /*
         * MaxID is only used for constructing a lookup table.
         * Decrease to save some possibly unneeded computation.
         */
        $r        = new HashFormat();
        $r->maxId = 0x10000;

        switch ($type) {
        case FileType::ArtLegacyMUL:
            {
                $r->maxId   = 0x13FDC; // UOFiddler requires this exact index length to recognize UOHS art files
                $r->address = array("build/artlegacymul/{fileIndex8}.tga", "");
                break;
            }
        case FileType::GumpartLegacyMUL:
            {
                //MaxID = 0xEF3C on 7.0.8.2
                $r->address = array("build/gumpartlegacymul/{fileIndex8}.tga", "build/gumpartlegacymul/{fileIndex8}.tga");
                break;
            }
        case FileType::MapLegacyMUL:
            {
                //MaxID = 0x71 on 7.0.8.2 for Fel/Tram
                $r->address = array("build/map" . $typeIndex . "legacymul/{fileIndex8}.dat", "");
                break;
            }
        case FileType::SoundLegacyMUL:
            {
                //MaxID = 0x1000 on 7.0.8.2
                $r->address = array("build/soundlegacymul/{fileIndex8}.dat", "");
                break;
            }
        case FileType::MultiMUL:
            {
                $r->address = array("build/multicollection/{fileIndex6}.bin", "");
                break;
            }
        default:
            {
                throw new Exception("Unknown file type!");
            }
        }
        return $r;
    }

    public static function getAddress($str, $index) {
        $paddedIndex = str_pad($index, 8, "0", STR_PAD_LEFT);
        $str         = str_replace("{fileIndex8}", $paddedIndex, $str);

        $paddedIndex = str_pad($index, 6, "0", STR_PAD_LEFT);
        $str         = str_replace("{fileIndex6}", $paddedIndex, $str);

        return $str;
    }
}

class HashFormat {
    public $maxId;
    public $address;
}

class TableEntry {
    public $m_Offset;
    public $m_HeaderLength;
    public $m_Size;
    public $m_SizeDecompressed;
    public $m_Identifier;
    public $m_Hash;
    public $m_Compression;
}

abstract class FileType {
    const ArtLegacyMUL     = 0;
    const GumpartLegacyMUL = 1;
    const MapLegacyMUL     = 2;
    const SoundLegacyMUL   = 3;
    const MultiMUL         = 4;
}