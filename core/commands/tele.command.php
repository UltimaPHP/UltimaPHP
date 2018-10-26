<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TeleCommand extends Command {
    public function __construct($client, $args = []) {
        if ($client === null) {
            return false;
        }

        if (empty($args)) {
            new SysmessageCommand($client, ["Where do you want to go?"]);
            array_unshift($args, 'tele');
            UltimaPHP::$socketClients[$client]['account']->player->attachTarget($client, ['method' => "GroundCommandCallback", 'args' => $args]);
            return true;
        }

        $x = $args[0];
        $y = $args[1];
        $z = (isset($args[2]) ? $args[2] : 0);
        $map = (isset($args[3]) ? $args[3] : UltimaPHP::$socketClients[$client]['account']->player->position['map']);

        if ($x === null || $y === null || $z === null || $map === null) {
            new SysmessageCommand($client, ["Sorry, information is missing. The default is \"x y z map\"."]);
            return false;
        }

        if ($map > (count(Map::$maps) - 1)) {
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
        $oldChunk = Map::getChunk($oldPosition['x'], $oldPosition['y']);
        $newChunk = Map::getChunk($x, $y);

        /* Update the player location before process updates */
        UltimaPHP::$socketClients[$client]['account']->player->position['x'] = $x;
        UltimaPHP::$socketClients[$client]['account']->player->position['y'] = $y;
        UltimaPHP::$socketClients[$client]['account']->player->position['z'] = $z;
        UltimaPHP::$socketClients[$client]['account']->player->position['map'] = $map;

        if ($oldPosition['map'] != $map || $oldChunk['x'] != $newChunk['x'] || $oldChunk['y'] != $newChunk['y']) {
            /* Remove the player from the map chunk view range */
            unset(Map::$chunks[$oldPosition['map']][$oldPosition['x']][$oldPosition['y']][UltimaPHP::$socketClients[$client]['account']->player->serial]);
            Map::addPlayerToMap(UltimaPHP::$socketClients[$client]['account']->player);

            /* Update player old chunk */
            Map::updateChunk($oldChunk, false, $oldPosition['map']);
        }

        UltimaPHP::$socketClients[$client]['account']->player->update();
        return true;
    }
}
