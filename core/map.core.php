<?php

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
    private static $chunks = [];
    private static $chunkSize = 256; // Number in square
    private static $tileMatrix = [];

    public function __construct() {
        $actualMap = 0;
        /**
         * Render the maps inside chunk arrays
         */
        while (isset(UltimaPHP::$conf["muls"]["map{$actualMap}"])) {
            $mapFile = UltimaPHP::$conf['muls']['location'] . "map{$actualMap}.mul";
            $mapSize = explode(",", UltimaPHP::$conf["muls"]["map{$actualMap}"]);

            UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_LOADING, array(
                $mapFile,
            ));

            if (!is_file($mapFile)) {
                UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_LOAD_FAIL);
                UltimaPHP::stop();
            }

            $chunks_x = ceil($mapSize[0] / self::$chunkSize);
            $chunks_y = ceil($mapSize[1] / self::$chunkSize);

            // Build the array that will store map chunks
            for ($xChunk = 0; $xChunk < $chunks_x; $xChunk++) {
                self::$chunks[$actualMap][$xChunk] = array();
                for ($yChunk = 0; $yChunk < $chunks_y; $yChunk++) {
                    self::$chunks[$actualMap][$xChunk][$yChunk] = array(
                        'objects' => array(),
                        'players' => array(),
                        'npcs' => array(),
                    );
                }
            }

            // Store information about the map muls and size
            self::$maps[$actualMap] = array(
                'mul' => null,
                'size' => array(
                    'x' => null,
                    'y' => null,
                ),
            );

            self::$mapSizes[$actualMap]['x'] = $mapSize[0];
            self::$mapSizes[$actualMap]['y'] = $mapSize[1];
            self::$maps[$actualMap]['mul'] = fopen($mapFile, "rb");
            self::$maps[$actualMap]['size']['x'] = (int) $mapSize[0] >> 3;
            self::$maps[$actualMap]['size']['y'] = (int) $mapSize[1] >> 3;

            // for ($x = 0; $x < self::$maps[$actualMap]['size']['x']; ++$x) {
            //     self::$maps[$actualMap][$x] = array();
            //     for ($y = 0; $y < self::$maps[$actualMap]['size']['y']; ++$y) {
            //         self::$maps[$actualMap][$x][$y] = array();

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

            UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_LOADED);
            $actualMap++;
        }

        // $chunks_x = ceil($mapSize[0] / self::$chunkSize);
        // $chunks_y = ceil($mapSize[1] / self::$chunkSize);

        // // Build the array that will store map chunks
        // for ($x = 0; $x < $chunks_x; $x++) {
        //     self::$chunks[$x] = array();
        //     for ($y = 0; $y < $chunks_y; $y++) {
        //         self::$chunks[$x][$y] = array(
        //             'objects' => array(),
        //             'players' => array(),
        //             'npcs' => array(),
        //         );
        //     }
        // }
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
        $mapSize = explode(",", UltimaPHP::$conf["muls"]["map{$actualMap}"]);

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
                        $static_x = hexdec(fread($staticMul, 1)); // ReadByte();
                        $static_y = hexdec(fread($staticMul, 1)); // ReadByte();
                        $static_z = hexdec(fread($staticMul, 1)); // ReadSByte();
                        $static_hue = hexdec(fread($staticMul, 2)); // ReadInt16();
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

        $updateRange = array(
            'from' => array('x' => ($pos_x - 10), 'y' => ($pos_y - 10)),
            'to' => array('x' => ($pos_x + 10), 'y' => ($pos_y + 10)),
        );

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
        //             	$tileId = Functions::read_byte($staticMul, 2);
        //             	$x = Functions::read_byte($staticMul, 1);
        //             	$y = Functions::read_byte($staticMul, 1);
        //             	$z = Functions::read_byte($staticMul, 1);
        //             	$hue = Functions::read_byte($staticMul, 2);
        //             	if ($tileId >= 0) {
        //             		if ($hue < 0) {
        //             			$hue = 0;
        //             		}
        //             		if ($tileId > 0) {
        //             			// echo "$tileId|$x|$y|$z|$hue\n";
        //             		}
        //             	}
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
    public static function getChunk($pos_x = null, $pos_y = null, $pos_map = null) {
        if ($pos_x === null || $pos_y === null || $pos_map === null || $pos_x <= 0 || $pos_y <= 0) {
            return false;
        }

        return array(
            'x' => (int) ceil($pos_x / self::$chunkSize),
            'y' => (int) ceil($pos_y / self::$chunkSize),
            'map' => (int) $pos_map,
        );
    }

    /**
     * Add the player to into the map and store information inside the right chunk
     */
    public static function addPlayerToMap(Player $player) {
        $chunk = self::getChunk($player->position['x'], $player->position['y'], $player->position['map']);
        self::$chunks[$player->position['map']][$chunk['x']][$chunk['y']]['players'][$player->client] = true;
        return true;
    }

    /**
     * 	Add the desired object into the map and store information inside the right chunk
     */
    public static function addObjectToMap(Object $object, $pos_x, $pos_y, $pos_z, $pos_m) {
        $object->pos_x = $pos_x;
        $object->pos_y = $pos_y;
        $object->pos_z = $pos_z;
        $object->pos_map = $pos_m;
        $object->location = "map";

        $chunk = self::getChunk($pos_x, $pos_y, $pos_m);
        self::$chunks[$pos_m][$chunk['x']][$chunk['y']]['objects'][] = $object;
        self::updateChunk($chunk, false);
        return true;
    }
    
        /**
     * 	Add the desired object into the map and store information inside the right chunk
     */
    public static function addMobileToMap(Mobile $mobile, $pos_x, $pos_y, $pos_z, $pos_m) {
        $mobile->position = array(
        	'x' => $pos_x,
        	'y'       => $pos_y,
            'z'       => $pos_z,
            'map'     => $pos_m,
            'facing'  => random_int(0, 6),
            'running' => 0,);
        $mobile->location = "map";

        $chunk = self::getChunk($pos_x, $pos_y, $pos_m);
        self::$chunks[$pos_m][$chunk['x']][$chunk['y']]['mobiles'][] = $mobile;
        self::updateChunk($chunk, false);
        return true;
    }

    /**
     * Update the player position and other players around
     */
    public static function updatePlayerLocation($client) {
        $player = UltimaPHP::$socketClients[$client]['account']->player;

        $chunk = self::getChunk($player->position['x'], $player->position['y'], $player->position['map']);

        /* Update the chunk that player is insite, if needed */
        self::$chunks[$player->position['map']][$chunk['x']][$chunk['y']]['players'][$client] = true;

        /* Send update packet information for players around player */
        self::updateChunk($chunk, $client);
        return true;
    }

    /**
     * Send desired packet to a range of players around the client
     */
    public static function sendPacketRange($packet = null, $client) {
        if ($packet === null) {
            return false;
        }

        $actual_player = UltimaPHP::$socketClients[$client]['account']->player;

        $chunkInfo = self::getChunk($actual_player->position['x'], $actual_player->position['y'], $actual_player->position['map']);
        $chunk = self::$chunks[$actual_player->position['map']][$chunkInfo['x']][$chunkInfo['y']];

        $updateRange = array(
            'from' => array('x' => ($actual_player->position['x'] - 10), 'y' => ($actual_player->position['y'] - 10)),
            'to' => array('x' => ($actual_player->position['x'] + 10), 'y' => ($actual_player->position['y'] + 10)),
        );

        foreach ($chunk['players'] as $client_id => $alive) {
            $player = UltimaPHP::$socketClients[$client_id]['account']->player;

            if ($actual_player->serial != $player->serial && $player->position['x'] >= $updateRange['from']['x'] && $player->position['x'] <= $updateRange['to']['x'] && $player->position['y'] >= $updateRange['from']['y'] && $player->position['y'] <= $updateRange['to']['y']) {
                Sockets::out($client_id, $packet, false);
            }
        }
    }

    /**
     * Update players with objects from desired chunk
     */
    public static function updateChunk($chunk = null, $client = false) {
        if ($chunk === null && $client !== false) {
            $chunk = self::getChunk(UltimaPHP::$socketClients[$client]['account']->player->position['x'], UltimaPHP::$socketClients[$client]['account']->player->position['y'], UltimaPHP::$socketClients[$client]['account']->player->position['map']);
        }

        if ($chunk === null) {
            self::log("Server tryied to update an invalid chunk", self::LOG_WARNING);
            return false;
        }

        $chunk = self::$chunks[$chunk['map']][$chunk['x']][$chunk['y']];

        if ($client !== false) {
            $actual_player = UltimaPHP::$socketClients[$client]['account']->player;
            $actual_player_plevel = UltimaPHP::$socketClients[$client]['account']->plevel;

            /* Update chars on map */
            foreach ($chunk['players'] as $client_id => $alive) {
                $player = UltimaPHP::$socketClients[$client_id]['account']->player;
                $player_plevel = UltimaPHP::$socketClients[$client_id]['account']->plevel;

                $position = $player->position;

                /* Defines boundries of player viewrange */
                $updateRange = array(
                    'from' => array('x' => ($position['x'] - $player->render_range), 'y' => ($position['y'] - $player->render_range)),
                    'to' => array('x' => ($position['x'] + $player->render_range), 'y' => ($position['y'] + $player->render_range)),
                );

                if ($actual_player->serial != $player->serial && $player->position['x'] >= $updateRange['from']['x'] && $player->position['x'] <= $updateRange['to']['x'] && $player->position['y'] >= $updateRange['from']['y'] && $player->position['y'] <= $updateRange['to']['y']) {
                    /* If actual player is invisible and tested player have no right plevel to see, don't need to proccess anything */
                    if ($actual_player->hidden && $player_plevel < $actual_player_plevel) {
                        $player->removeObjectFromView($actual_player->serial);
                        continue;
                    }

                    if (!array_key_exists($client_id, $actual_player->mapRange['players'])) {
                        $actual_player->mapRange['players'][$client_id] = true;
                        $actual_player->drawChar(false, $client_id);
                    }
                    $actual_player->updatePlayer($client_id);

                    if (!array_key_exists($actual_player->client, $player->mapRange['players'])) {
                        $player->mapRange['players'][$actual_player->client] = true;
                        $player->drawChar(false, $actual_player->client);
                    }
                    $player->updatePlayer($client);
                } else {
                    if ($actual_player->serial != $player->serial) {
                        continue;
                    }

                    if (isset($actual_player->mapRange['players'][$player->client])) {
                        unset($actual_player->mapRange['players'][$player->client]);
                        $actual_player->removeObjectFromView($player->serial);
                    }
                    if (isset($player->mapRange['players'][$actual_player->client])) {
                        unset($player->mapRange['players'][$actual_player->client]);
                        $player->removeObjectFromView($actual_player->serial);
                    }
                }
            }
        }

        /* Update items on map */
        foreach ($chunk['objects'] as $object) {
            $packet = "F3";
            $packet .= "0001";
            $packet .= "00";
            $packet .= $object->serial;
            $packet .= str_pad(dechex($object->graphic), 4, "0", STR_PAD_LEFT);
            $packet .= "00";
            $packet .= str_pad(dechex($object->amount), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($object->amount), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($object->pos_x), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($object->pos_y), 4, "0", STR_PAD_LEFT);
            $packet .= Functions::toChar8($object->pos_z);
            $packet .= str_pad(dechex($object->layer), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($object->color), 4, "0", STR_PAD_LEFT);
            $packet .= "20";
            $packet .= "0000";

            foreach ($chunk['players'] as $client => $alive) {
                $player = UltimaPHP::$socketClients[$client]['account']->player;

                $updateRange = array(
                    'from' => array('x' => ($object->pos_x - $player->render_range), 'y' => ($object->pos_y - $player->render_range)),
                    'to' => array('x' => ($object->pos_x + $player->render_range), 'y' => ($object->pos_y + $player->render_range)),
                );

                if ($player->position['x'] >= $updateRange['from']['x'] && $player->position['x'] <= $updateRange['to']['x'] && $player->position['y'] >= $updateRange['from']['y'] && $player->position['y'] <= $updateRange['to']['y']) {
                    Sockets::out($player->client, $packet, false);
                }
            }
        }
    }

}
