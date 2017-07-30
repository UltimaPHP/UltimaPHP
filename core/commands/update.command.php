<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class UpdateCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null) {
        	return false;
        }

        UltimaPHP::$socketClients[$client]['account']->player->update();
        
        return true;
    }
}