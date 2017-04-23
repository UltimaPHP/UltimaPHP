<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TeleCommand extends Command {

    public function __construct($client, $args = []) {

        if ($client === null || !isset($args[0]) || !isset($args[1])) {
            return false;
        }

        $x = $args[0];
        $y = $args[1];
        $z = (isset($args[2]) ? $args[2] : 0);
        $map = (isset($args[3]) ? $args[3] : UltimaPHP::$socketClients[$client]['account']->player->position['map']);

    	if ($x === null || $y === null || $z === null || $map === null) {
            new SysmessageCommand($client, ["Sorry, information is missing. The default is \"x y z map\"."]);
            return false;
        }
        
        if ($map > (count(Map::$maps)-1)) {
            new SysmessageCommand($client, ["Sorry, but the map you'r trying to go doesn't exists."]);
            return false;
        }

        $mapBoundries = Map::$mapSizes[$map];

        if ($x <= 0 || $x > $mapBoundries['x'] || $y <= 0 || $y > $mapBoundries['y']) {
            new SysmessageCommand($client, ["Sorry, but you are trying to go outside the map boundries."]);
            return false;
        }

        /* Update old position to ensure other players keep updated */
        $oldPosition = UltimaPHP::$socketClients[$client]['account']->player->position;

        /* Clear old objects from map view */
        foreach (UltimaPHP::$socketClients[$client]['account']->player->mapRange as $serial => $info) {
            UltimaPHP::$socketClients[$client]['account']->player->removeObjectFromView($serial);
        }

        $chunk = Map::getChunk($oldPosition['x'], $oldPosition['y']);
        unset(Map::$chunks[$oldPosition['map']][$oldPosition['x']][$oldPosition['y']][UltimaPHP::$socketClients[$client]['account']->player->serial]);
        
        UltimaPHP::$socketClients[$client]['account']->player->position['x'] = $x;
		UltimaPHP::$socketClients[$client]['account']->player->position['y'] = $y;
		UltimaPHP::$socketClients[$client]['account']->player->position['z'] = $z;
        UltimaPHP::$socketClients[$client]['account']->player->position['map'] = $map;
		UltimaPHP::$socketClients[$client]['account']->player->mapRange = [];
		UltimaPHP::$socketClients[$client]['account']->player->updateCursorColor(false, $map);
        UltimaPHP::$socketClients[$client]['account']->player->drawChar();
        UltimaPHP::$socketClients[$client]['account']->player->drawPlayer();

        /* Update player old chunk */
        Map::updateChunk($chunk, null, $oldPosition['map']);
        /* Update player new chunk */
        Map::updateChunk(null, $client);
        return true;
    }
}   