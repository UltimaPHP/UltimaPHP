<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class MusicCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null || !isset($args[0])) {
            return false;
        }

        UltimaPHP::$socketClients[$client]['account']->player->playMusic(false, (int) $args[0]);

        return true;
    }
}
