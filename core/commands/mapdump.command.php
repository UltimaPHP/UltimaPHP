<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class MapdumpCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null) {
            return false;
        }

        $player = UltimaPHP::$socketClients[$client]['account']->player;

        $position = $player->position;
        // $position['x']--;

        $viewRange = [
            'from' => ['x' => ($player->position['x'] - UltimaPHP::$conf['muls']['render_range']), 'y' => ($player->position['y'] - UltimaPHP::$conf['muls']['render_range'])],
            'to' => ['x' => ($player->position['x'] + UltimaPHP::$conf['muls']['render_range']), 'y' => ($player->position['y'] + UltimaPHP::$conf['muls']['render_range'])],
        ];

        $map = [];

        $mY = 0;
        for ($y = $viewRange['from']['y']; $y <= $viewRange['to']['y']; $y++) {
            $map[$mY] = [];
            $mX = 0;

            for ($x = $viewRange['from']['x']; $x <= $viewRange['to']['x']; $x++) {
                $canWalk = true;

                $staticsTiles = Map::getTerrainStatics($x, $y, $player->position['z'], $player->position['map']);
                
                if ($staticsTiles) {
                    foreach ($staticsTiles as $tile) {
                        if (abs($tile['position']['z'] - $player->position['z']) >= 20) {
                            continue;
                        }

                        if ($tile['flags'] & TiledataDefs::STAIRBACK || $tile['flags'] & TiledataDefs::STAIRRIGHT) {
                            continue;
                        }

                        if ($tile['flags'] & TiledataDefs::WALL || $tile['flags'] & TiledataDefs::IMPASSABLE || $tile['flags'] & TiledataDefs::DOOR) {
                            $canWalk = false;
                        }
                    }
                }

                if ($player->position['x'] == $x && $player->position['y'] == $y) {
                    $map[$mY][$mX] = 1; // Source
                } else if ($position['x'] == $x && $position['y'] == $y) {
                    $map[$mY][$mX] = 2; // Destination
                } else {
                    $map[$mY][$mX] = ($canWalk ? 0 : 4);
                }
                $mX++;
            }
            $mY++;
        }

        $flowPath = new FlowPath($map, true);
        $steps = $flowPath->getPath();

        $flowPath->dumpPath();


        return true;
    }
}
