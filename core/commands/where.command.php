<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class WhereCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null) {
            return false;
        }

        $player = UltimaPHP::$socketClients[$client]['account']->player;
        new SysmessageCommand($client, ["Your position is ".$player->position['x'].",".$player->position['y'].",".$player->position['z'].",".$player->position['map']]);
        
        return true;
    }
}