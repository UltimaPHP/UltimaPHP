<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class ICommand {
    public function __construct($client = null, $args = []) {
        if ($client === null) {
            return false;
        }

        $itemDef = str_replace(" ", "_", $args[0]);

        if (!class_exists($itemDef)) {
            new SysmessageCommand($client, ["Sorry, but the item you are trying to create (" . $args[0] . ") has not been found."]);
            return false;
        }

        $item = new $itemDef();
        $player = UltimaPHP::$socketClients[$client]['account']->player;
	    Map::addObjectToMap($item, $player->position['x'], $player->position['y'], $player->position['z'], $player->position['map']);
	    unset($player);
        return true;
    }
}
