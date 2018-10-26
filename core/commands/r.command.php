<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class RCommand extends Command {
    public function __construct($client, $args = []) {
        if ($client === null) {
            return false;
        }

        if (!isset($args[0])) {
            new SysmessageCommand($client, ["What do you want to remove?"]);
            array_unshift($args, 'remove');
            UltimaPHP::$socketClients[$client]['account']->player->attachTarget($client, ['method' => "ObjectCommandCallback", 'args' => $args]);
            return true;
        }

        $target = $args[0];

        if ($target === null) {
            new SysmessageCommand($client, ["Sorry, could not find object with serial $serial."]);
            return false;
        }

        if ($target === null || $target == "00000000") {
            new SysmessageCommand($client, ["Sorry, object you are trying to remove does not exist."]);
            return false;
        }

        $instance = Map::getBySerial($target);

        if ($instance->instanceType == UltimaPHP::INSTANCE_PLAYER) {
            return false;
        }

        $instance->remove();
        Map::removeSerialData($target);

        $packet = "1D";
        $packet .= str_pad($target, 8, "0", STR_PAD_LEFT);

        $updateChunk = false;

        if ($instance->instanceType == UltimaPHP::INSTANCE_MOBILE) {
            $updateChunk = true;
        } else if ($instance->instanceType == UltimaPHP::INSTANCE_OBJECT) {
            if ($instance->holder === null) {
                $updateChunk = true;
            } else {
                //it is inside a container remove for all clients looking inside container
            }
        }

        if ($updateChunk) {
            $chunk = Map::getChunk($instance->position['x'], $instance->position['y']);
            Map::sendPacketRangePosition($packet, $instance->position);
        }

        return true;
    }
}
