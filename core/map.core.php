<?php

class MapCache {
	public $map = [];
	public $mapSizes = [];
	public $chunks = [];
	public $tileMatrix = [];
}
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Map {
    /**
     * Map loading variables
     */
    public static $maps = [];
    public static $mapSizes = [];
    public static $chunks = [];
    public static $chunkSize = 512; // Number in square
    public static $tileMatrix = [];
    public static $serialData = [];
    public static $serialDataHolded = [];
    public static $serialMobsHolded = [];
    public static $gumpsIds = [];
    private static $tiledata = [];
    private static $lastSerial = [
        'mobile' => 0,
        'object' => 100000,
    ];

    public function __construct() {
    }

    public static function readTiledata() {
        $tiledata = UltimaPHP::$conf['muls']['location'] . "tiledata.mul";

        if (!is_file($tiledata)) {
            UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_READ_FAIL, [$tiledata]);
            UltimaPHP::stop();
        }

        self::$tiledata = [
            Others::TILEDATA_LAND => [],
            Others::TILEDATA_STATIC => [],
        ];

        UltimaPHP::$files[Reader::FILE_TILEDATA] = new Reader($tiledata, Reader::FILE_TILEDATA);

        $cache = Cache::exists($tiledata);

				if (!is_null($cache)) {
            self::$tiledata = $cache->fileContents;
            Functions::progressBar(1, 1, "Reading tiledata.mul (cache)");
        } else {
            Functions::progressBar(0, 1, "Reading tiledata.mul");

            $highSeas = true;

            for ($i = 0; $i < 0x4000; $i += 32) {
                $header = UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt32();

                for ($count = 0; $count < 32; ++$count) {
                    if (!$highSeas) {
                        $blockInfo = [
                            'type' => 'land',
                            'flags' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readUInt32(),
                            'texture' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt16(),
                            'name' => trim(Functions::readUnicodeStringSafe(str_split(Functions::strToHex(UltimaPHP::$files[Reader::FILE_TILEDATA]->read(20)), 2))),
                        ];
                    } else {
                        $blockInfo = [
                            'type' => 'land',
                            'flags' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readUInt32(),
                            'unknown' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readUInt32(),
                            'texture' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt16(),
                            'name' => trim(Functions::readUnicodeStringSafe(str_split(Functions::strToHex(UltimaPHP::$files[Reader::FILE_TILEDATA]->read(20)), 2))),
                        ];
                    }

                    self::$tiledata[Others::TILEDATA_LAND][$i + $count] = $blockInfo;
                }
            }

            $remaining = UltimaPHP::$files[Reader::FILE_TILEDATA]->fileLength - UltimaPHP::$files[Reader::FILE_TILEDATA]->getAcutalPosition();

            $staticItemSize = (!$highSeas ? 37 : 41);
            $remainingHeaders = ($remaining / (($staticItemSize * 32) + 4));
            $totalStaticItems = $remainingHeaders * 32;

            for ($i = 0; $i < $totalStaticItems; $i += 32) {
                $header = UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt32();

                for ($count = 0; $count < 32; ++$count) {
                    $blockInfo = [
                        'type' => 'static',
                        'flags' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readUInt32(),
                        'unknown1' => (!$highSeas ? 0 : UltimaPHP::$files[Reader::FILE_TILEDATA]->readUInt32()),
                        'weight' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'quality' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'miscdata' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt16(),
                        'unknown2' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'quantity' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'animation' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt16(),
                        'unknown3' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'hue' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'stackingoffset' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'value' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'height' => UltimaPHP::$files[Reader::FILE_TILEDATA]->readInt8(),
                        'name' => Functions::readUnicodeStringSafe(str_split(Functions::strToHex(UltimaPHP::$files[Reader::FILE_TILEDATA]->read(20)), 2)),
                    ];

                    self::$tiledata[Others::TILEDATA_STATIC][$i + $count] = $blockInfo;
                }
            }

            Functions::progressBar(1, 1, "Reading tiledata.mul");
            Cache::writeFile($tiledata, self::$tiledata);
        }
        self::readMaps();
		}
		
		private static function readMapFile($mapFile, $mapName) {
			if (!is_file($mapFile)) {
					UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_READ_FAIL, [$mapFile]);
					UltimaPHP::stop();
			}

			if (!isset(UltimaPHP::$files[$mapName])) {
				UltimaPHP::$files[mapName] = [];
			}

			return new Reader($mapFile, mapName);
		}

    /**
     * Render the maps inside chunk arrays
     */
    public static function readMaps() {
        for ($actualMap = 0; $actualMap < UltimaPHP::$conf["muls"]['maps']; $actualMap++) {
						$mapFile = UltimaPHP::$conf['muls']['location'] . "map{$actualMap}LegacyMUL.uop";

            if (!is_file($mapFile)) {
								UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_READ_FAIL, [$mapFile]);
								UltimaPHP::stop();
						}

						if (!isset(UltimaPHP::$files[Reader::FILE_MAP_FILE])) {
								UltimaPHP::$files[Reader::FILE_MAP_FILE] = [];
						}

						UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap] = new Reader($mapFile, Reader::FILE_MAP_FILE);
				
            $cache = Cache::exists($mapFile);

            if (!is_null($cache)) {
                $cache = $cache->fileContents;
    						self::$maps[$actualMap] = $cache->map;
    						self::$mapSizes[$actualMap] = $cache->mapSizes;
    						self::$chunks[$actualMap] = $cache->chunks;
								self::$tileMatrix[$actualMap] = $cache->tileMatrix;

                Functions::progressBar(1, 1, "Reading " . $mapFile . " (cache)");
            } else {
                /* Start reading the map files of actual map */
                Functions::progressBar(0, 1, "Reading map{$actualMap}LegacyMUL.uop file");

                $mapSize = explode(",", UltimaPHP::$conf["muls"]["map{$actualMap}"]);

                if (dechex(UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->readInt32()) == 0x50594D) {
                    UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_READ_FAIL, [$mapFile, 'The file doesn\'t seems to be a valid UOP file.']);
                    UltimaPHP::stop();
                }

                $chunks_x = ceil($mapSize[0] / self::$chunkSize);
                $chunks_y = ceil($mapSize[1] / self::$chunkSize);

                // Build the array that will store map chunks
                for ($xChunk = 0; $xChunk < $chunks_x; $xChunk++) {
                    self::$chunks[$actualMap][$xChunk] = [];
                    for ($yChunk = 0; $yChunk < $chunks_y; $yChunk++) {
                        self::$chunks[$actualMap][$xChunk][$yChunk] = [];
                    }
                }

                // Store information about the map muls and size
                self::$maps[$actualMap] = [
                    'mul' => null,
                    'size' => [
                        'x' => null,
                        'y' => null,
                    ],
                ];

                self::$mapSizes[$actualMap]['x'] = $mapSize[0];
                self::$mapSizes[$actualMap]['y'] = $mapSize[1];
                self::$maps[$actualMap]['mul'] = fopen($mapFile, "rb");
                self::$maps[$actualMap]['size']['x'] = (int) $mapSize[0] >> 3;
                self::$maps[$actualMap]['size']['y'] = (int) $mapSize[1] >> 3;

                /* Creates the empty map tile matrix */
                if (!isset(self::$tileMatrix[$actualMap])) {
                    self::$tileMatrix[$actualMap] = [];
                }

                for ($bx = 0; $bx <= self::$maps[$actualMap]['size']['x']; $bx++) {
                    if (!isset(self::$tileMatrix[$actualMap][$bx])) {
                        self::$tileMatrix[$actualMap][$bx] = [];
                    }
                    for ($by = 0; $by <= self::$maps[$actualMap]['size']['y']; $by++) {
                        if (!isset(self::$tileMatrix[$actualMap][$bx][$by])) {
                            self::$tileMatrix[$actualMap][$bx][$by] = [];
                        }
                    }
                }

                /* Proccess the UOP file into the server memory */
                if (!UltimaPHP::$testMode) {
                    UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->setPosition(0);

                    $magicSeed = UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->readInt32();
                    $version = UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->readInt32();
                    $signature = UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->readInt32();
                    $nextTable = UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->readInt64();

                    $offsets = [];

                    while ($nextTable != 0) {
                        UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->setPosition($nextTable);

                        $entries = UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->readInt32();
                        $nextTable = UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->readInt64();

                        for ($i = 0; $i < $entries; $i++) {
                            /*
                             * Empty entries are read too, because they do not always indicate the
                             * end of the table. (Example: 7.0.26.4+ Fel/Tram maps)
                             */
                            $tmp = [
                                'offset' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->ReadInt64(),
                                'headerLength' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->ReadInt32(), // header length
                                'size' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->ReadInt32(), // compressed size
                                'sizeDecompressed' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->ReadInt32(), // decompressed size
                                'identifier' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->ReadUInt64(), // filename hash (HashLittle2)
                                'hash' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->ReadUInt32(), // data hash (Adler32)
                                'compression' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->ReadInt16(), // compression method (0 = none, 1 = zlib)
                            ];

                            if ($tmp['offset'] <= 0 || $tmp['size'] <= 0) {
                                continue;
                            }

                            $offsets[] = $tmp;
                        }
                    }

                    $offsetCount = count($offsets);

                    foreach ($offsets as $offsetKey => $offset) {
                        UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->setPosition(($offset['offset'] + $offset['headerLength']));
                        $rawData = Functions::strToHex(UltimaPHP::$files[Reader::FILE_MAP_FILE][$actualMap]->read($offset['size']));

                        // TODO: Proccess the block raw data

                        Functions::progressBar($offsetKey, $offsetCount, "Reading map{$actualMap}LegacyMUL.uop file");
                    }

                    Functions::progressBar($offsetCount, $offsetCount, "Reading map{$actualMap}LegacyMUL.uop file");
                } else {
                    Functions::progressBar(1, 1, "Reading map{$actualMap}LegacyMUL.uop file");
								}

								$cache = new MapCache();
								$cache->map = self::$maps[$actualMap];
								$cache->mapSizes = self::$mapSizes[$actualMap];
								$cache->chunks = self::$chunks[$actualMap];
								$cache->tileMatrix = self::$tileMatrix[$actualMap];
								Cache::writeFile($mapFile, $cache);
							}

							/* Start reading the staidx file of actual map */
							Functions::progressBar(0, 1, "Reading staidx{$actualMap}.mul file");

							$indexFile = UltimaPHP::$conf['muls']['location'] . "staidx{$actualMap}.mul";

							if (!is_file($indexFile)) {
									UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_READ_FAIL, [$indexFile]);
									UltimaPHP::stop();
							}

							if (!isset(UltimaPHP::$files[Reader::FILE_STATIC_INDEX])) {
									UltimaPHP::$files[Reader::FILE_STATIC_INDEX] = [];
							}

							UltimaPHP::$files[Reader::FILE_STATIC_INDEX][$actualMap] = new Reader($indexFile, Reader::FILE_MAP_FILE);

							Functions::progressBar(1, 1, "Reading staidx{$actualMap}.mul file");

							/* Start reading the statics file of actual map */
							Functions::progressBar(0, 1, "Reading statics{$actualMap}.mul file");
							$staticFile = UltimaPHP::$conf['muls']['location'] . "statics{$actualMap}.mul";

							if (!is_file($staticFile)) {
									UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_READ_FAIL, [$staticFile]);
									UltimaPHP::stop();
							}

							if (!isset(UltimaPHP::$files[Reader::FILE_STATIC_FILE])) {
									UltimaPHP::$files[Reader::FILE_STATIC_FILE] = [];
							}
							UltimaPHP::$files[Reader::FILE_STATIC_FILE][$actualMap] = new Reader($staticFile, Reader::FILE_MAP_FILE);

							Functions::progressBar(1, 1, "Reading statics{$actualMap}.mul file");

							/* Start reading the mapdif file of actual map, if enabled */
							if (UltimaPHP::$conf['muls']['useDif']) {
									$diffFile = UltimaPHP::$conf['muls']['location'] . "mapdif{$actualMap}.mul";

									if (file_exists($diffFile)) {
											Functions::progressBar(0, 1, "Reading mapdif{$actualMap}.mul file");

											if (!isset(UltimaPHP::$files[Reader::FILE_MAP_DIF])) {
													UltimaPHP::$files[Reader::FILE_MAP_DIF] = [];
											}

											if (!isset(UltimaPHP::$files[Reader::FILE_MAP_DIF][$actualMap])) {
													UltimaPHP::$files[Reader::FILE_MAP_DIF][$actualMap] = null;
											}

											if (is_file($diffFile)) {
													UltimaPHP::$files[Reader::FILE_MAP_DIF][$actualMap] = new Reader($diffFile, Reader::FILE_MAP_DIF);
											}

											Functions::progressBar(1, 1, "Reading mapdif{$actualMap}.mul file");
									}
							}
        }
		}

    public static function readObjects() {
        $objects = UltimaPHP::$db->collection('objects')->find([])->toArray();

        $total = count($objects);

        if ($total) {
            Functions::progressBar(0, 1, "Reading world objects");

            foreach ($objects as $count => $object) {
                $itemClass = $object['objectName'];
                $instance = new $itemClass($object['serial'], $object['id']);

                /* Update last object serial stored on server */
                if (self::$lastSerial['object'] < $object['id']) {
                    self::$lastSerial['object'] = $object['id'];
                }

                /* Clear database object before update variables */
                foreach ($object as $attr => $value) {
                    $instance->$attr = (in_array($attr, ['serial', 'holder']) && $value !== null ? strtoupper($value) : $value);
                }

                if ($instance->holder === null) {
                    self::addObjectToMap($instance, $instance->position['x'], $instance->position['y'], $instance->position['z'], $instance->position['map']);
                } else {
                    self::addHoldedObject($instance);
                }
            }

            Functions::progressBar(1, 1, "Reading world objects");
        }

        return true;
    }

    public static function readMobiles() {
        $objects = UltimaPHP::$db->collection('mobiles')->find([])->toArray();

        $total = count($objects);

        if ($total) {
            Functions::progressBar(0, 1, "Reading world mobiles");

            foreach ($objects as $count => $mobile) {
                $itemClass = $mobile['objectName'];
                $instance = new $itemClass($mobile['serial'], ($mobile['ridable'] ? $mobile['owner'] : null));

                /* Update last object serial stored on server */
                if (self::$lastSerial['mobile'] < $mobile['id']) {
                    self::$lastSerial['mobile'] = $mobile['id'];
                }

                /* Clear database object before update variables */
                foreach ($mobile as $attr => $value) {
                    $instance->$attr = (in_array($attr, ['serial', 'owner']) && $value !== null ? strtoupper($value) : $value);
                }

                if (!$instance->riding) {
                    self::addMobileToMap($instance, $instance->position['x'], $instance->position['y'], $instance->position['z'], $instance->position['map']);
                } else {
                    self::addHoldedObject($instance);
                }
            }

            Functions::progressBar(1, 1, "Reading world objects");
        }

        return true;
    }

    public static function addHoldedObject(Object $instance) {
        self::$serialDataHolded[$instance->serial] = $instance;
        return true;
    }

    public static function addHoldedMobile(Mobile $instance) {
        self::$serialMobsHolded[$instance->serial] = $instance;
        return true;
    }

    /* Tries do define what is the right Z position from */
    public static function getTopItemFrom($x = 0, $y = 0, $z = 0, $map = 0, $maxHeight = 10) {
        if ($x == 0 || $y == 0) {
            return false;
        }

        if (!isset(UltimaPHP::$files[Reader::FILE_MAP_FILE][$map])) {
            return false;
        }

        $mapBoundries = self::$mapSizes[$map];
        if ($x <= 0 || $x > $mapBoundries['x'] || $y <= 0 || $y > $mapBoundries['y']) {
            return false;
        }

        $land = self::getTerrainLand($x, $y, $z, $map, $maxHeight);
        $statics = self::getTerrainStatics($x, $y, $z, $map, $maxHeight);

        if (count($land) == 0 && count($statics) == 0) {
            return false;
        }

        $topItem = $land;

        foreach ($statics as $item) {
            $itemFinalZ = ($item['position']['z'] + $item['height']);

            if ($z > ($itemFinalZ + $maxHeight) || $z < ($itemFinalZ - $maxHeight)) {
                continue;
            }

            if (!$topItem) {
                $topItem = $item;
                continue;
            }

            if ($itemFinalZ >= $topItem['position']['z']) {
                $item['position']['z_orig'] = $item['position']['z'];
                $item['position']['z'] = $itemFinalZ;
                $topItem = $item;
            }
        }

        return $topItem;
    }

    public static function getTerrainLand($p_x = 0, $p_y = 0, $p_z = 0, $map = 0, $maxHeight = 10) {
        if ($p_x == 0 || $p_y == 0) {
            return [];
        }

        if (!isset(UltimaPHP::$files[Reader::FILE_MAP_FILE][$map])) {
            return [];
        }

        $x = $p_x >> 3;
        $y = $p_y >> 3;

        $offset = ((($x * self::$maps[$map]['size']['y']) + $y) * 196) + 4;

        UltimaPHP::$files[Reader::FILE_MAP_FILE][$map]->setPosition($offset);

        for ($bx = 0; $bx < 8; $bx++) {
            for ($by = 0; $by < 8; $by++) {
                $info = [
                    'tile' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$map]->readInt16(),
                    'position' => [
                        'x' => ($x << 3) + $bx,
                        'y' => ($y << 3) + $by,
                        'z' => UltimaPHP::$files[Reader::FILE_MAP_FILE][$map]->readInt8(),
                    ],
                ];

                // if (isset(self::$tiledata[Others::TILEDATA_LAND][$info['tile']]) && $info['position']['x'] == $p_x && $info['position']['y'] == $p_y && abs($info['position']['z'] - $p_z) < $maxHeight) {
                if (isset(self::$tiledata[Others::TILEDATA_LAND][$info['tile']]) && is_array(self::$tiledata[Others::TILEDATA_LAND][$info['tile']]) && $info['position']['x'] == $p_x && $info['position']['y'] == $p_y) {
                    return array_merge(self::$tiledata[Others::TILEDATA_LAND][$info['tile']], ['tile' => $info['tile'], 'position' => $info['position']]);
                }
            }
        }

        return [];
    }

    public static function getTerrainStatics($p_x = 0, $p_y = 0, $p_z = 0, $map = 0, $maxHeight = 10) {
        if ($p_x == 0 || $p_y == 0) {
            return [];
        }

        if (!isset(UltimaPHP::$files[Reader::FILE_STATIC_INDEX][$map]) || !isset(UltimaPHP::$files[Reader::FILE_STATIC_FILE][$map])) {
            return [];
        }

        $x = $p_x >> 3;
        $y = $p_y >> 3;

        $offset = (($x * self::$maps[$map]['size']['y']) + $y) * 12;

        UltimaPHP::$files[Reader::FILE_STATIC_INDEX][$map]->setPosition($offset);

        $lookup = UltimaPHP::$files[Reader::FILE_STATIC_INDEX][$map]->readInt32();
        $length = UltimaPHP::$files[Reader::FILE_STATIC_INDEX][$map]->readInt32();

        if ($lookup <= 0 || $length <= 0) {
            return [];
        }

        UltimaPHP::$files[Reader::FILE_STATIC_FILE][$map]->setPosition($lookup);

        $tiles = [];
        for ($i = 0; $i <= $length / 7; $i++) {
            $info = [
                'tile' => UltimaPHP::$files[Reader::FILE_STATIC_FILE][$map]->readInt16(),
                'position' => [
                    'x' => ($x << 3) + UltimaPHP::$files[Reader::FILE_STATIC_FILE][$map]->readUInt8(),
                    'y' => ($y << 3) + UltimaPHP::$files[Reader::FILE_STATIC_FILE][$map]->readUInt8(),
                    'z' => UltimaPHP::$files[Reader::FILE_STATIC_FILE][$map]->readInt8(),
                ],
                'hue' => UltimaPHP::$files[Reader::FILE_STATIC_FILE][$map]->readInt16(),
            ];

            if (isset(self::$tiledata[Others::TILEDATA_STATIC][$info['tile']]) && $info['position']['x'] == $p_x && $info['position']['y'] == $p_y) {
                $tiles[] = array_merge(self::$tiledata[Others::TILEDATA_STATIC][$info['tile']], ['position' => $info['position'], 'hue' => $info['hue']]);
            }
        }

        if (count($tiles) == 0) {
            return [];
        }

        return $tiles;
    }

    /**
     * Creates a new serial based on last serial created
     */
    public static function newSerial($type = null) {
        if ($type === null) {
            return false;
        }

        self::$lastSerial[$type]++;
        return (isset(self::$serialData[self::$lastSerial[$type]]) ? self::newSerial($type) : self::$lastSerial[$type]);
    }

    /**
     * Return the chunk number of desired map position
     */
    public static function getChunk($pos_x = null, $pos_y = null) {
        if ($pos_x === null || $pos_y === null || $pos_x <= 0 || $pos_y <= 0) {
            return false;
        }

        return [
            'x' => (int) ceil($pos_x / self::$chunkSize),
            'y' => (int) ceil($pos_y / self::$chunkSize),
        ];
    }

    public static function removeSerialData($serial = null, $evenHolded = false) {
        if ($serial === null) {
            return false;
        }

        if (!isset(self::$serialData[$serial])) {
            if ($evenHolded && isset(self::$serialDataHolded[$serial])) {
                unset(self::$serialDataHolded[$serial]);
            } else {
                if ($evenHolded && isset(self::$serialMobsHolded[$serial])) {
                    unset(self::$serialMobsHolded[$serial]);
                } else {
                    return false;
                }
            }
        } else {
            $instance = self::getBySerial($serial);
            $pos = $instance->position;
            $chunk = self::getChunk($pos['x'], $pos['y']);
            unset(self::$serialData[$serial]);
            unset(self::$chunks[$pos['map']][$chunk['x']][$chunk['y']][$serial]);
        }

        return true;
    }

    /**
     * Add the player to into the map and store information inside the right chunk
     */
    public static function addPlayerToMap(Player $player) {
        $chunk = self::getChunk($player->position['x'], $player->position['y']);

        self::$chunks[$player->position['map']][$chunk['x']][$chunk['y']][(int) $player->serial] = [
            'type' => "player",
            'client' => $player->client,
            'instance' => null,
        ];

        self::$serialData[(int) $player->serial] = ['map' => $player->position['map'], 'x' => $chunk['x'], 'y' => $chunk['y']];

        return true;
    }

    /**
     *     Add the desired object into the map and store information inside the right chunk
     */
    public static function addObjectToMap(Object $object, $pos_x, $pos_y, $pos_z, $pos_m, $holderSerial = null) {
        $object->position = [
            'x' => $pos_x,
            'y' => $pos_y,
            'z' => $pos_z,
            'map' => $pos_m,
            'facing' => 0,
            'running' => 0,
        ];

        $object->holder = ($holderSerial !== null ? $holderSerial : null);
        $object->save();

        $chunk = self::getChunk($pos_x, $pos_y);

        self::$chunks[$pos_m][$chunk['x']][$chunk['y']][$object->serial] = [
            'type' => 'object',
            'client' => null,
            'holder' => $holderSerial,
            'instance' => $object,
        ];

        self::$serialData[$object->serial] = ['map' => $pos_m, 'x' => $chunk['x'], 'y' => $chunk['y']];

        self::updateChunk($chunk, false, $pos_m);

        return true;
    }

    public static function updateObjectHolder(Object $instance) {
        if (!$instance || !isset(self::$serialDataHolded[$instance->serial])) {
            return false;
        }

        self::$serialDataHolded[$instance->serial] = $instance;

        return true;
    }

    public static function updateMobileHolder(Mobile $instance) {
        if (!$instance || !isset(self::$serialMobsHolded[$instance->serial])) {
            return false;
        }

        self::$serialMobsHolded[$instance->serial] = $instance;

        return true;
    }

    public static function updateChunkForced($position = null) {
        if ($position === null) {
            return false;
        }

        $chunk = self::getChunk($position['x'], $position['y']);
        self::updateChunk($chunk, false, $position['map'], true);
        return true;
    }

    /**
     *     Add the desired object into the map and store information inside the right chunk
     */
    public static function addMobileToMap(Mobile $mobile, $pos_x, $pos_y, $pos_z, $pos_m) {
        $mobile->position = [
            'x' => $pos_x,
            'y' => $pos_y,
            'z' => $pos_z,
            'map' => $pos_m,
            'facing' => random_int(0, 6),
            'running' => 0,
        ];
        $mobile->location = "map";
        $mobile->save();

        $chunk = self::getChunk($pos_x, $pos_y);

        self::$chunks[$pos_m][$chunk['x']][$chunk['y']][$mobile->serial] = [
            'type' => "mobile",
            'client' => null,
            'instance' => $mobile,
        ];

        self::$serialData[$mobile->serial] = ['map' => $pos_m, 'x' => $chunk['x'], 'y' => $chunk['y']];

        self::updateChunk($chunk, false, $pos_m);

        return true;
    }

    public static function isValidSerial($serial = false) {
        if ($serial === false) {
            return false;
        }

        $serial = (int) $serial;

        if (!isset(self::$serialData[$serial])) {
            if (!isset(self::$serialDataHolded[$serial])) {
                if (!isset(self::$serialMobsHolded[$serial])) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        }

        $chunk = self::$serialData[$serial];
        $info = self::$chunks[$chunk['map']][$chunk['x']][$chunk['y']][$serial];

        switch ($info['type']) {
            case 'player':
            case 'mobile':
            case 'object':
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    public static function getBySerial($serial = false) {
        if ($serial === false) {
            return false;
        }

        $serial = ltrim($serial, '0');

        if (!isset(self::$serialData[$serial])) {
            if (!isset(self::$serialDataHolded[$serial])) {
                if (!isset(self::$serialMobsHolded[$serial])) {
                    return false;
                } else {
                    return self::$serialMobsHolded[$serial];
                }
            } else {
                return self::$serialDataHolded[$serial];
            }
        }

        $chunk = self::$serialData[$serial];
        $info = self::$chunks[$chunk['map']][$chunk['x']][$chunk['y']][$serial];

        switch ($info['type']) {
            case 'player':
                return UltimaPHP::$socketClients[$info['client']]['account']->player;
                break;
            case 'mobile':
            case 'object':
                return $info['instance'];
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Send desired packet to a range of players around the client
     */
    public static function sendPacketRange($packet = null, $client) {
        if ($packet === null) {
            return false;
        }

        $actual_player = UltimaPHP::$socketClients[$client]['account']->player;

        $chunkInfo = self::getChunk($actual_player->position['x'], $actual_player->position['y']);
        $chunk = self::$chunks[$actual_player->position['map']][$chunkInfo['x']][$chunkInfo['y']];

        $updateRange = [
            'from' => ['x' => ($actual_player->position['x'] - UltimaPHP::$conf['muls']['render_range']), 'y' => ($actual_player->position['y'] - UltimaPHP::$conf['muls']['render_range'])],
            'to' => ['x' => ($actual_player->position['x'] + UltimaPHP::$conf['muls']['render_range']), 'y' => ($actual_player->position['y'] + UltimaPHP::$conf['muls']['render_range'])],
        ];

        foreach ($chunk as $serial => $data) {
            if ($data['type'] != "player") {
                continue;
            }

            $player = UltimaPHP::$socketClients[$data['client']]['account']->player;

            if ($actual_player->serial != $player->serial && $player->position['x'] >= $updateRange['from']['x'] && $player->position['x'] <= $updateRange['to']['x'] && $player->position['y'] >= $updateRange['from']['y'] && $player->position['y'] <= $updateRange['to']['y']) {
                Sockets::out($player->client, $packet, false);
            }
        }
    }

    /**
     * Send the text message to the NPC's and mobile around player as hearing action
     */
    public static function sendHearMessage($text = null, $client) {
        if ($text === null) {
            return false;
        }

        $actual_player = UltimaPHP::$socketClients[$client]['account']->player;

        $chunkInfo = self::getChunk($actual_player->position['x'], $actual_player->position['y']);
        $chunk = self::$chunks[$actual_player->position['map']][$chunkInfo['x']][$chunkInfo['y']];

        $updateRange = [
            'from' => ['x' => ($actual_player->position['x'] - UltimaPHP::$conf['muls']['render_range']), 'y' => ($actual_player->position['y'] - UltimaPHP::$conf['muls']['render_range'])],
            'to' => ['x' => ($actual_player->position['x'] + UltimaPHP::$conf['muls']['render_range']), 'y' => ($actual_player->position['y'] + UltimaPHP::$conf['muls']['render_range'])],
        ];

        foreach ($chunk as $serial => $data) {
            if ($data['type'] == "mobile") {
                $data['instance']->hear($text, $client);
            }
        }
    }

    /**
     * Send desired packet to a range of players around desired position
     */
    public static function sendPacketRangePosition($packet = null, $position = null) {
        if ($packet === null || $position === null) {
            return false;
        }

        $chunkInfo = self::getChunk($position['x'], $position['y']);
        $chunk = self::$chunks[$position['map']][$chunkInfo['x']][$chunkInfo['y']];

        $updateRange = [
            'from' => ['x' => ($position['x'] - UltimaPHP::$conf['muls']['render_range']), 'y' => ($position['y'] - UltimaPHP::$conf['muls']['render_range'])],
            'to' => ['x' => ($position['x'] + UltimaPHP::$conf['muls']['render_range']), 'y' => ($position['y'] + UltimaPHP::$conf['muls']['render_range'])],
        ];

        foreach ($chunk as $serial => $data) {
            if ($data['type'] != "player") {
                continue;
            }

            $player = UltimaPHP::$socketClients[$data['client']]['account']->player;
            if ($player->position['x'] >= $updateRange['from']['x'] && $player->position['x'] <= $updateRange['to']['x'] && $player->position['y'] >= $updateRange['from']['y'] && $player->position['y'] <= $updateRange['to']['y']) {
                Sockets::out($player->client, $packet, false);
            }
        }
    }

    /**
     * Update players with objects from desired chunk
     * $map is only used in case of the request come from a mobile or items
     */
    //self::updateChunk($chunk, false, $position['map'], true);
    public static function updateChunk($chunk = null, $client = false, $map = null, $forceItemUpdate = false) {
        if ($chunk === null && $client !== false) {
            $chunk = self::getChunk(UltimaPHP::$socketClients[$client]['account']->player->position['x'], UltimaPHP::$socketClients[$client]['account']->player->position['y']);
            $map = UltimaPHP::$socketClients[$client]['account']->player->position['map'];
        }

        if ($chunk === null) {
            UltimaPHP::log("Server tryied to update an invalid chunk", UltimaPHP::LOG_WARNING);
            return false;
        }

        if ($map === null) {
            UltimaPHP::log("Server tryied to update an chunk form invalid map", UltimaPHP::LOG_WARNING);
            return false;
        }

        $chunkData = self::$chunks[$map][$chunk['x']][$chunk['y']];

        /* Loop trought every player and updates everything in view range */
        foreach ($chunkData as $serial => $data) {
            if ($data['type'] != "player") {
                continue;
            }

            $actual_player = UltimaPHP::$socketClients[$data['client']]['account']->player;
            $actual_player_plevel = UltimaPHP::$socketClients[$data['client']]['account']->plevel;

            $updateRange = [
                'from' => ['x' => ($actual_player->position['x'] - $actual_player->render_range), 'y' => ($actual_player->position['y'] - $actual_player->render_range)],
                'to' => ['x' => ($actual_player->position['x'] + $actual_player->render_range), 'y' => ($actual_player->position['y'] + $actual_player->render_range)],
            ];

            /* Loop trought every items and mobiles to update on player view */
            foreach ($chunkData as $serialTest => $dataTest) {
                if ($dataTest['type'] != "player") {
                    if (($dataTest['type'] == "mobile" && $dataTest['instance']->ridable && $dataTest['instance']->riding) || ($actual_player->position['map'] != $dataTest['instance']->position['map']) || (abs($actual_player->position['x'] - $dataTest['instance']->position['x']) > $actual_player->render_range || abs($actual_player->position['y'] - $dataTest['instance']->position['y']) > $actual_player->render_range)) {
                        if (isset($actual_player->mapRange[$serialTest])) {
                            $actual_player->removeObjectFromView($serialTest);
                        }
                    } else if (!isset($actual_player->mapRange[$serialTest])) {
                        if ($dataTest['type'] == "mobile" && $dataTest['instance']->ridable && $dataTest['instance']->riding) {
                            continue;
                        }
                        $actual_player->mapRange[$serialTest] = [
                            'status' => true,
                            'lastupdate' => time(),
                        ];
                        $dataTest['instance']->draw($actual_player->client);
                    }
                } else {
                    $player = UltimaPHP::$socketClients[$dataTest['client']]['account']->player;
                    $player_plevel = UltimaPHP::$socketClients[$dataTest['client']]['account']->plevel;

                    /* Remove running flags if player stoped */
                    if (UltimaPHP::$socketClients[$dataTest['client']]['account']->player->position['running'] == true && (time() - UltimaPHP::$socketClients[$dataTest['client']]['account']->player->lastMove) > 2) {
                        UltimaPHP::$socketClients[$dataTest['client']]['account']->player->position['running'] = false;
                    }

                    if (($actual_player->position['map'] != $player->position['map'] || abs($actual_player->position['x'] - $player->position['x']) > $actual_player->render_range || abs($actual_player->position['y'] - $player->position['y']) > $actual_player->render_range) || ($player->hidden && $actual_player_plevel < $player_plevel)) {
                        if (isset($actual_player->mapRange[$player->serial])) {
                            echo "Removing (2): " . $player->serial . "\n";
                            $actual_player->removeObjectFromView($player->serial);
                        }
                        continue;
                    }

                    if ($actual_player->serial != $player->serial) {
                        if (!isset($actual_player->mapRange[$player->serial]) || (time() - $actual_player->mapRange[$player->serial]['lastupdate']) > 2 || $player->forceUpdate == true) {
                            $actual_player->mapRange[$player->serial] = [
                                'status' => true,
                                'lastupdate' => time(),
                            ];
                            $actual_player->drawChar(false, $player->client);
                        }

                        $actual_player->updatePlayer($player->client);
                    }
                }
            }
        }
        return true;
    }
}
