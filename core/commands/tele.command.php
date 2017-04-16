<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TeleCommand extends Command {

    public function __construct($client, $args = []) {

        if ($client === null || !isset($args[0]) || !isset($args[1])) {
            return false;
        }

        $x = $args[0];
        $y = $args[1];
        $z = (isset($args[2]) ? $args[2] : 0);
        $map = (isset($args[3]) ? $args[3] : UltimaPHP::$socketClients[$client]['account']->player->position['map']);

    	if ($x === null || $y === null || $z === null || $map === null) {
            new SysmessageCommand($client, ["Sorry, information is missing. The default is \"x y z map\""]);
            return false;
        }
        
        $mapSize = explode(",", UltimaPHP::$conf["muls"]["map{$map}"]);
        
        if($x <= $mapSize[0] && $y <= $mapSize[1] && $z <= $mapSize[2] )
        {
			UltimaPHP::$socketClients[$client]['account']->player->position['x'] = $x;
			UltimaPHP::$socketClients[$client]['account']->player->position['y'] = $y;
			UltimaPHP::$socketClients[$client]['account']->player->position['z'] = $z;
			UltimaPHP::$socketClients[$client]['account']->player->position['map'] = $map;
			UltimaPHP::$socketClients[$client]['account']->player->updateCursorColor(false, $map);
		    UltimaPHP::$socketClients[$client]['account']->player->drawChar();
		    UltimaPHP::$socketClients[$client]['account']->player->drawPlayer();
		    Map::updateChunk(null, $client);	
		}else{
			new SysmessageCommand($client, ["Sorry, you blew the map boundary, try another position.. "]);
			return false;
		}

		
        return true;
    }
}   