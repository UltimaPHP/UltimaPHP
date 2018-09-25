<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class InfoCommand extends Command {
    public function __construct($client, $args = []) {

        if ($client === null) {
            return false;
        }
		
		if (isset($args[0]) && $args[0] == "gump") {	
			// $teste = new TestGump($client);	
			$teste = new GoMenuGump($client);	
			$teste->show();	
			return true;	
		}

        if (isset($args[0]) && $args[0] == "around") {
            $position = UltimaPHP::$socketClients[$client]['account']->player->position;

            print_r([
                "NORTH"     => Map::getTerrainLand($position['x'], $position['y'] - 1, $position['z'], $position['map']),
                "NORTHEAST" => Map::getTerrainLand($position['x'] + 1, $position['y'] - 1, $position['z'], $position['map']),
                "EAST"      => Map::getTerrainLand($position['x'] + 1, $position['y'], $position['z'], $position['map']),
                "SOUTHEAST" => Map::getTerrainLand($position['x'] + 1, $position['y'] + 1, $position['z'], $position['map']),
                "SOUTH"     => Map::getTerrainLand($position['x'], $position['y'] + 1, $position['z'], $position['map']),
                "SOUTHWEST" => Map::getTerrainLand($position['x'] - 1, $position['y'] + 1, $position['z'], $position['map']),
                "WEST"      => Map::getTerrainLand($position['x'] - 1, $position['y'], $position['z'], $position['map']),
                "NORTHWEST" => Map::getTerrainLand($position['x'] - 1, $position['y'] - 1, $position['z'], $position['map']),
                "CENTER"    => Map::getTerrainLand($position['x'], $position['y'], $position['z'], $position['map']),
            ]);
            return true;
        }

        if (isset($args[0]) && $args[0] == "layers") {
            print_r(UltimaPHP::$socketClients[$client]['account']->player->layers[LayersDefs::BACKPACK]);
            return true;
        }

        if (isset($args[0]) && $args[0] == "serial") {
            print_r(Map::$serialData);
            print_r(Map::$serialDataHolded);
            return true;
        }

        if (isset($args[0]) && $args[0] == "chunk") {
            $chunk     = Map::getChunk(UltimaPHP::$socketClients[$client]['account']->player->position['x'], UltimaPHP::$socketClients[$client]['account']->player->position['y']);
            $chunkData = Map::$chunks[UltimaPHP::$socketClients[$client]['account']->player->position['map']][$chunk['x']][$chunk['y']];

            echo "Printing data from chunk position: \n";
            print_r(UltimaPHP::$socketClients[$client]['account']->player->position);
            print_r($chunkData);

            return true;
        }

        UltimaPHP::$socketClients[$client]['account']->player->attachTarget($client, ['method' => "InfoCommandCallback", 'args' => []]);
        return true;
    }
}