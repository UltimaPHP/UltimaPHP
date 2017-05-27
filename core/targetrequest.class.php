<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TargetRequest {
    public static function responsed($client, $target) {
        $player   = UltimaPHP::$socketClients[$target['cursor']]['account']->player;

        if ($target['target'] == TargetDefs::TARGET_OBJECT) {
            $instance = Map::getBySerial((int) $target['serial']);
        
            if (!$instance) {
                new SysmessageCommand($client, ["Sorry, but server could not find the desired target."]);
                return false;
            }

            if ($instance->instanceType == UltimaPHP::INSTANCE_PLAYER) {
                new SysmessageCommand($client, ["Target at player " . $instance->name . "."]);
            } else if ($instance->instanceType == UltimaPHP::INSTANCE_MOBILE) {
                new SysmessageCommand($client, ["Target at mobile " . $instance->name . "."]);
            } else if ($instance->instanceType == UltimaPHP::INSTANCE_OBJECT) {
                new SysmessageCommand($client, ["Target at item " . $instance->name . "."]);
            }
        } elseif ($target['target'] == TargetDefs::TARGET_LAND) {
            new SysmessageCommand($client, ["Target at " . $target['x'] . ",".$target['y'].",".$target['z']."."]);
        }

        return true;
    }
}