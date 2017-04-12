<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class SysmessageCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null || !isset($args[0])) {
        	return false;
        }

        $message = $args[0];
        $color = (isset($args[1]) ? $args[1] : UltimaPHP::$conf['colors']['text']);

        UltimaPHP::$socketClients[$client]['account']->player->speech("06", $color, 3, "PTB ", $message);
        
        return true;
    }
}