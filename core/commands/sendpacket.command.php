<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class SendPacketCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null || !isset($args[0])) {
        	return false;
        }

        $packet = $args[0];
        Sockets::out($client, $packet);
        return true;
    }
}