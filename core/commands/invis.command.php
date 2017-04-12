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


        $player = UltimaPHP::$socketClients[$client]['account']->player;
	    UltimaPHP::$socketClients[$client]['account']->player->hidden = ($force ? $args[0] : ($player->hidden == false || $player->hidden == null ? true : false));
	    unset($player);
	    
		UltimaPHP::$socketClients[$client]['account']->player->drawPlayer();
        return true;
    }
}