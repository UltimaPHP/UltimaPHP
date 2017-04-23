<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class MCommand {
    public function __construct($client = null, $args = []) {
        if ($client === null) {
            return false;
        }

        $mobileDef = str_replace(" ", "_", $args[0]);

        if (!isset(class_parents($mobileDef)['Mobile'])) {
            new SysmessageCommand($client, ["Sorry, but you are trying to add a item as an mobile, use .i ".$args[0]." to add this item."]);
            return false;
        }

        if (!class_exists($mobileDef)) {
            new SysmessageCommand($client, ["Sorry, but the mobile you are trying to create (" . $args[0] . ") has not been found."]);
            return false;
        }

        $mobile = new $mobileDef();
        $player = UltimaPHP::$socketClients[$client]['account']->player;

	    Map::addMobileToMap($mobile, $player->position['x'], $player->position['y'], $player->position['z'], $player->position['map']);
	    unset($player);
        return true;
    }
}
