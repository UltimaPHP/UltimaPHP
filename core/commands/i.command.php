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

        if (strstr($args[0], " ")) {
            $tmp = explode(" ", $args[0]);
            $itemDef = "";
            foreach ($tmp as $v) {
                $itemDef .= ucfirst($v);
            }
        } else {
            $itemDef = $args[0];
        }

        if (!class_exists($itemDef)) {
            new SysmessageCommand($client, ["Sorry, but the item you are trying to create (" . $itemDef . ") has not been found."]);
            return false;
        }

        if (!isset(class_parents($itemDef)['Object'])) {
            new SysmessageCommand($client, ["Sorry, but you are trying to add a mobile as an item, use .m ".$itemDef." to add this mobile."]);
            return false;
        }


        $item = new $itemDef();
        $player = UltimaPHP::$socketClients[$client]['account']->player;
	    Map::addObjectToMap($item, $player->position['x'], $player->position['y'], $player->position['z'], $player->position['map']);
	    unset($player);
        return true;
    }
}
