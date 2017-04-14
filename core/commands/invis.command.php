<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class InvisCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null) {
        	return false;
        }

        $force = (isset($args[0]) ? (in_array($args[0], [0,1]) ? true : false) : false);


        $hidden = UltimaPHP::$socketClients[$client]['account']->player->hidden;
	    UltimaPHP::$socketClients[$client]['account']->player->hidden = ($force ? $args[0] : ($hidden == false || $hidden == null ? true : false));
	    
        // UltimaPHP::$socketClients[$client]['account']->player->drawChar();
        UltimaPHP::$socketClients[$client]['account']->player->drawPlayer();
        // Map::updatePlayerLocation($client);
        Map::updateChunk(null, $client);
        return true;
    }
}