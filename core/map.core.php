<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Map {

    /**
     * Map loading variables
     */
    public static $maps        = [];
    public static $mapSizes    = [];
    public static $chunks      = [];
    public static $chunkSize   = 256; // Number in square
    public static $tileMatrix  = [];
    private static $serialData = [];
    private static $lastSerial = [
        'mobile' => 0,
        'object' => 0,
    ];

    public function __construct() {
        $actualMap = 0;
        /**
         * Render the maps inside chunk arrays
         */
       	
        while (isset(UltimaPHP::$conf["muls"]["map{$actualMap}"])) {
            $mapFile = UltimaPHP::$conf['muls']['location'] . "map{$actualMap}.mul";
            $mapSize = explode(",", UltimaPHP::$conf["muls"]["map{$actualMap}"]);

            if (!is_file($mapFile)) {
                UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_LOAD_FAIL);
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
                'mul'  => null,
                'size' => [
                    'x' => null,
                    'y' => null,
                ],
            ];

            self::$mapSizes[$actualMap]['x']     = $mapSize[0];
            self::$mapSizes[$actualMap]['y']     = $mapSize[1];
            self::$maps[$actualMap]['mul']       = fopen($mapFile, "rb");
            self::$maps[$actualMap]['size']['x'] = (int) $mapSize[0] >> 3;
            self::$maps[$actualMap]['size']['y'] = (int) $mapSize[1] >> 3;

            // for ($x = 0; $x < self::$maps[$actualMap]['size']['x']; ++$x) {
            //     self::$maps[$actualMap][$x] = [];
            //     for ($y = 0; $y < self::$maps[$actualMap]['size']['y']; ++$y) {
            //         self::$maps[$actualMap][$x][$y] = [];

            //         fseek(self::$maps[$actualMap]['mul'], ((($x * self::$maps[$actualMap]['size']['y']) + $y) * 196), SEEK_SET);
            //         $header = hexdec(bin2hex(fread(self::$maps[$actualMap]['mul'], 4)));

            //         for ($i = 0; $i < 64; ++$i) {
            //             $tile = bin2hex(fread(self::$maps[$actualMap]['mul'], 2));
            //             $z = hexdec(bin2hex(fread(self::$maps[$actualMap]['mul'], 1)));
            //             if ((hexdec($tile) < 0) || ($tile >= 0x4000)) {
            //                 $tile = 0;
            //             }
            //             if ($z < -128) {
            //                 $z = -128;
            //             }
            //             if ($z > 127) {
            //                 $z = 127;
            //             }
            //             if ($tile > 0) {
            //                 echo "$tile|$x,$y,$z,$actualMap\n";
            //                 // self::$maps[$actualMap][$x][$y][$z] = $tile;
            //             }
            //         }
            //     }
            // }

            /* Send the server proccess and map the statics from actual map */
            // self::readStaticsFromPosition(0, 1429, 1695);
            // self::readStatics($actualMap);
            $actualMap++;
        }

        // $chunks_x = ceil($mapSize[0] / self::$chunkSize);
        // $chunks_y = ceil($mapSize[1] / self::$chunkSize);

        // // Build the array that will store map chunks
        // for ($x = 0; $x < $chunks_x; $x++) {
        //     self::$chunks[$x] = [];
        //     for ($y = 0; $y < $chunks_y; $y++) {
        //         self::$chunks[$x][$y] = array(
        //             'objects' => [],
        //             'players' => [],
        //             'npcs' => [],
        //         );
        //     }
        // }
    }

    public static function newSerial($type = null) {
        if ($type === null) {
            return false;
        }

        self::$lastSerial[$type]++;
        return (isset(self::$serialData[self::$lastSerial[$type]]) ? self::newSerial($type) : self::$lastSerial[$type]);
    }

    /**
     * Read statics tiles from the .mul file
     */
    public static function readStatics($actualMap = false) {
        if ($actualMap === false) {
            return false;
        }

        $staticIdx = fopen(UltimaPHP::$conf['muls']['location'] . "statics{$actualMap}.mul", 'rb');
        $staticMul = fopen(UltimaPHP::$conf['muls']['location'] . "staidx{$actualMap}.mul", 'rb');
        $mapSize   = explode(",", UltimaPHP::$conf["muls"]["map{$actualMap}"]);

        $block_x = (int) $mapSize[0] >> 3;
        $block_y = (int) $mapSize[1] >> 3;

        $binidx = $binmul = "";

        $byteStream;

        for ($x = 0; $x < $block_x; ++$x) {
            for ($y = 0; $y < $block_y; ++$y) {
                /* Set the position of file to the actual point of file */

                fseek($staticIdx, (($x * $block_y) + $y) * 12, SEEK_SET);
                $data = Functions::strToHex(fread($staticIdx, 12));

                // echo ((($x * $block_y) + $y) * 12) . ": " . $data . "\n";
                // continue;
                // $lookup = hexdec(fread($staticIdx, 4));
                // $length = hexdec(fread($staticIdx, 4));
                // $extra = hexdec(fread($staticIdx, 4));

                if ($lookup < 0 || $length <= 0) {

                } else {
                    if (($lookup >= 0) && ($length > 0)) {
                        fseek($staticMul, $lookup, SEEK_SET);
                    }

                    $count = $length / 7;

                    $firstitem = true;

                    for ($i = 0; $i < $count; ++$i) {
                        $static_graphic = hexdec(fread($staticMul, 2)); // ReadUInt16();
                        $static_x       = hexdec(fread($staticMul, 1)); // ReadByte();
                        $static_y       = hexdec(fread($staticMul, 1)); // ReadByte();
                        $static_z       = hexdec(fread($staticMul, 1)); // ReadSByte();
                        $static_hue     = hexdec(fread($staticMul, 2)); // ReadInt16();
                        // echo "$static_graphic|$static_x|$static_y|$static_z|$static_hue\n";
                        // continue;
                        if ($static_graphic >= 0) {
                            if ($static_hue < 0) {
                                $static_hue = 0;
                            }

                            if ($firstitem) {
                                $binidx .= Functions::strToHex($lookup);
                                $firstitem = false;
                            }

                            if ($static_graphic > 0) {
                                echo "$static_graphic|$static_x|$static_y|$static_z|$static_hue\n";
                            }

                            $binmul .= Functions::strToHex($static_graphic);
                            $binmul .= Functions::strToHex($static_x);
                            $binmul .= Functions::strToHex($static_y);
                            $binmul .= Functions::strToHex($static_z);
                            $binmul .= Functions::strToHex($static_hue);
                        } else {
                            $binmul .= Functions::strToHex("00");
                            $binmul .= Functions::strToHex("0");
                            $binmul .= Functions::strToHex("0");
                            $binmul .= Functions::strToHex("00");
                            $binmul .= Functions::strToHex("00");
                        }
                    }
                }
            }
        }
    }

    public static function readStaticsFromPosition($map, $pos_x, $pos_y) {
        $staticIdx = fopen(UltimaPHP::$conf['muls']['location'] . "statics{$map}.mul", 'rb');
        $staticMul = fopen(UltimaPHP::$conf['muls']['location'] . "staidx{$map}.mul", 'rb');

        $updateRange = [
            'from' => ['x' => ($pos_x - 10), 'y' => ($pos_y - 10)],
            'to'   => ['x' => ($pos_x + 10), 'y' => ($pos_y + 10)],
        ];

        // for ($x = $updateRange['from']['x']; $x < $updateRange['to']['x']; $x++) {
        //     for ($y = $updateRange['from']['y']; $y < $updateRange['to']['y']; $y++) {
        //         $index = (($x * self::$maps[$map]['size']['y']) + $y) * 12;
        //         fseek($staticIdx, $index, SEEK_SET);

        //         $lookup = (int) Functions::strToHex(fread($staticIdx, 4));
        //         $length = (int) Functions::strToHex(fread($staticIdx, 4));
        //         // $lookup = Functions::read_byte($staticIdx, 4);
        //         // $length = Functions::read_byte($staticIdx, 4);
        //         echo "$lookup|$length\n";
        //         if ($length > 0 && $lookup > 0) {
        //             echo "$lookup|$length\n";

        //             fseek($staticMul, $lookup, SEEK_SET);
        //             for ($i=0; $i < ($length/7); $i++) {
        //                 $tileId = Functions::read_byte($staticMul, 2);
        //                 $x = Functions::read_byte($staticMul, 1);
        //                 $y = Functions::read_byte($staticMul, 1);
        //                 $z = Functions::read_byte($staticMul, 1);
        //                 $hue = Functions::read_byte($staticMul, 2);
        //                 if ($tileId >= 0) {
        //                     if ($hue < 0) {
        //                         $hue = 0;
        //                     }
        //                     if ($tileId > 0) {
        //                         // echo "$tileId|$x|$y|$z|$hue\n";
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        // exit();

        // $data = bin2hex(fread($staticMul, $length));
        // echo "\n\n\nFIM\n\n\n";
        // exit();
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

    /**
     * Add the player to into the map and store information inside the right chunk
     */
    public static function addPlayerToMap(Player $player) {
        $chunk = self::getChunk($player->position['x'], $player->position['y']);

        self::$chunks[$player->position['map']][$chunk['x']][$chunk['y']][(int)$player->serial] = [
            'type'     => "player",
            'client'   => $player->client,
            'instance' => null,
        ];

        self::$serialData[(int)$player->serial] = ['map' => $player->position['map'], 'x' => $chunk['x'], 'y' => $chunk['y']];

        return true;
    }

    /**
     *     Add the desired object into the map and store information inside the right chunk
     */
    public static function addObjectToMap(Object $object, $pos_x, $pos_y, $pos_z, $pos_m) {
        $object->position = [
            'x'       => $pos_x,
            'y'       => $pos_y,
            'z'       => $pos_z,
            'map'     => $pos_m,
            'facing'  => 0,
            'running' => 0,
        ];

        $chunk = self::getChunk($pos_x, $pos_y);

        self::$chunks[$pos_m][$chunk['x']][$chunk['y']][$object->serial] = [
            'type'     => 'object',
            'client'   => null,
            'instance' => $object,
        ];

        self::$serialData[$object->serial] = ['map' => $pos_m, 'x' => $chunk['x'], 'y' => $chunk['y']];

        self::updateChunk($chunk, false, $pos_m);

        return true;
    }

    /**
     *     Add the desired object into the map and store information inside the right chunk
     */
    public static function addMobileToMap(Mobile $mobile, $pos_x, $pos_y, $pos_z, $pos_m) {
        $mobile->position = [
            'x'       => $pos_x,
            'y'       => $pos_y,
            'z'       => $pos_z,
            'map'     => $pos_m,
            'facing'  => random_int(0, 6),
            'running' => 0,
        ];
        $mobile->location = "map";

        $chunk = self::getChunk($pos_x, $pos_y);

        self::$chunks[$pos_m][$chunk['x']][$chunk['y']][$mobile->serial] = [
            'type'     => "mobile",
            'client'   => null,
            'instance' => $mobile,
        ];

        self::$serialData[$mobile->serial] = ['map' => $pos_m, 'x' => $chunk['x'], 'y' => $chunk['y']];

        self::updateChunk($chunk, false, $pos_m);

        return true;
    }

    public static function getBySerial($serial = false) {
        if ($serial === false) {
            return false;
        }

        $serial = (int)$serial;

        if (!isset(self::$serialData[$serial])) {
            return false;
        }

        $chunk = self::$serialData[$serial];
        $info  = self::$chunks[$chunk['map']][$chunk['x']][$chunk['y']][$serial];
		
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
        $chunk     = self::$chunks[$actual_player->position['map']][$chunkInfo['x']][$chunkInfo['y']];

        $updateRange = [
            'from' => ['x' => ($actual_player->position['x'] - UltimaPHP::$conf['muls']['render_range']), 'y' => ($actual_player->position['y'] - UltimaPHP::$conf['muls']['render_range'])],
            'to'   => ['x' => ($actual_player->position['x'] + UltimaPHP::$conf['muls']['render_range']), 'y' => ($actual_player->position['y'] + UltimaPHP::$conf['muls']['render_range'])],
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
     * Send desired packet to a range of players around desired position
     */
    public static function sendPacketRangePosition($packet = null, $position  = null) {
        if ($packet === null || $position === null) {
            return false;
        }

        $chunkInfo = self::getChunk($position['x'], $position['y']);
        $chunk     = self::$chunks[$position['map']][$chunkInfo['x']][$chunkInfo['y']];

        $updateRange = [
            'from' => ['x' => ($position['x'] - UltimaPHP::$conf['muls']['render_range']), 'y' => ($position['y'] - UltimaPHP::$conf['muls']['render_range'])],
            'to'   => ['x' => ($position['x'] + UltimaPHP::$conf['muls']['render_range']), 'y' => ($position['y'] + UltimaPHP::$conf['muls']['render_range'])],
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
    public static function updateChunk($chunk = null, $client = false, $map = null) {
        if ($chunk === null && $client !== false) {
            $chunk = self::getChunk(UltimaPHP::$socketClients[$client]['account']->player->position['x'], UltimaPHP::$socketClients[$client]['account']->player->position['y']);
            $map   = UltimaPHP::$socketClients[$client]['account']->player->position['map'];
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

            $actual_player        = UltimaPHP::$socketClients[$data['client']]['account']->player;
            $actual_player_plevel = UltimaPHP::$socketClients[$data['client']]['account']->plevel;

            $updateRange = [
                'from' => ['x' => ($actual_player->position['x'] - $actual_player->render_range), 'y' => ($actual_player->position['y'] - $actual_player->render_range)],
                'to'   => ['x' => ($actual_player->position['x'] + $actual_player->render_range), 'y' => ($actual_player->position['y'] + $actual_player->render_range)],
            ];

            /* Remove objects that was removed from player view */
            foreach ($actual_player->mapRange as $serialTest => $active) {
                $actual_player->removeObjectFromView($serialTest);
            }

            /* Loop trought every items and mobiles to update on player view */
            foreach ($chunkData as $serialTest => $dataTest) {
                if ($dataTest['type'] != "player") {
                    /* Do not send draw packets again if object is allready in player view */
                    if ($serialTest == $serial) {
                        continue;
                    }

                    /* If mobile/item leaves player map view range, removes */
                    if (isset($actual_player->mapRange[$serialTest]) && !Functions::inRangeView($dataTest['instance']->position, $updateRange)) {
                        $actual_player->removeObjectFromView($serialTest);
                        continue;
                    }

                    if (!isset($actual_player->mapRange[$serialTest]) && Functions::inRangeView($dataTest['instance']->position, $updateRange)) {
                        $dataTest['instance']->draw($actual_player->client);
                    }
                } else {
                    $player        = UltimaPHP::$socketClients[$dataTest['client']]['account']->player;
                    $player_plevel = UltimaPHP::$socketClients[$dataTest['client']]['account']->plevel;

                    if ($player->hidden && $actual_player_plevel < $player_plevel) {
                        if (isset($actual_player->mapRange[$player->serial])) {
                            $actual_player->removeObjectFromView($player->serial);
                        }
                        continue;
                    }

                    if ($actual_player->serial != $player->serial) {
                        if (!isset($actual_player->mapRange[$player->serial])) {
                            $actual_player->mapRange[$player->serial] = true;
                            $actual_player->drawChar(false, $player->client);
                        } else {
                            $actual_player->updatePlayer($player->client);
                        }
                    }
                }
            }
        }

        return true;
    }

}
