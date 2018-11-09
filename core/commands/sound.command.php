<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class SoundCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null || !isset($args[0])) {
            return false;
        }

        UltimaPHP::$socketClients[$client]['account']->player->playSound($client, [(int)$args[0], UltimaPHP::$socketClients[$client]['account']->player->position]);

        return true;
    }
}
