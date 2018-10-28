<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class PlayerCallbacks {
    public $client;

    public function __construct($client = false) {
        if (!$client) {
            return false;
        }

        $this->client = $client;
    }

    public function GeneralCommandCallback($target, $args) {
        $instance = Map::getBySerial((int) $target['serial']);

        if ($instance->instanceType == UltimaPHP::INSTANCE_PLAYER) {
            $command = "." . $args['command'] . (count($args['args']) > 0 ? " " . implode(",", $args['args']) : "");
            return Command::threatCommand($instance->client, $command, $this->client, true);
        } else if ($instance->instanceType == UltimaPHP::INSTANCE_MOBILE || $instance->instanceType == UltimaPHP::INSTANCE_OBJECT) {
            if (method_exists($instance, $args['command'])) {
                $cmd = $args['command'];
                return $instance->$cmd((count($args['args']) == 1 ? $args['args'][0] : $args['args']));
            } else {
                new SysmessageCommand($this->client, ["Invalid command callback executed."]);
                return false;
            }
        }
    }

    public function GroundCommandCallback($target, $args = []) {
        $x = $target['x'];
        $y = $target['y'];
        $z = $target['z'];

        if ($target['serial'] != "00000000") {
            new SysmessageCommand($this->client, ["Invalid location."]);
            return false;
        }

        $command = array_shift($args);
        return Command::threatCommand($this->client, "." . $command . " $x,$y,$z");
    }

    public function ObjectCommandCallback($target, $args = []) {
        if ($target['serial'] == "00000000") {
            new SysmessageCommand($this->client, ["Invalid object."]);
            return false;
        }

        $command = array_shift($args);
        array_push($args, $target['serial']);
        return Command::threatCommand($this->client, "." . $command . " " . implode(",", $args));
    }

    public function InfoCommandCallback($target, $args = []) {
        if ($target['target'] == TargetDefs::OBJECT) {
            $instance = Map::getBySerial((int) $target['serial']);

            if (!$instance) {
                $this->target = null;
                new SysmessageCommand($this->client, ["Sorry, but server could not find the desired target."]);
                return false;
            }

            if ($instance->instanceType == UltimaPHP::INSTANCE_PLAYER) {
                new SysmessageCommand($this->client, ["Target at player " . $instance->name . "."]);
            } else if ($instance->instanceType == UltimaPHP::INSTANCE_MOBILE) {
                new SysmessageCommand($this->client, ["Target at mobile " . $instance->name . "."]);
            } else if ($instance->instanceType == UltimaPHP::INSTANCE_OBJECT) {
                new SysmessageCommand($this->client, ["Target at item " . $instance->name . "."]);
            }
        } elseif ($target['target'] == TargetDefs::LAND) {
            $playerPos = UltimaPHP::$socketClients[$this->client]['account']->player->position;

            $landTiles = Map::getTerrainLand($target['x'], $target['y'], $target['z'], $playerPos['map']);
            $staticsTiles = Map::getTerrainStatics($target['x'], $target['y'], $target['z'], $playerPos['map']);
            $topLevel = Map::getTopItemFrom($target['x'], $target['y'], $target['z'], $playerPos['map']);

            echo "Target:\n";
            print_r($target);

            echo "Land tiles at target: \n";
            print_r($landTiles);

            echo "Static tiles at target: \n";
            print_r($staticsTiles);

            echo "Top Level Item: \n";
            print_r($topLevel);

            new SysmessageCommand($this->client, ["Target at " . $target['x'] . "," . $target['y'] . "," . $target['z'] . "."]);
        } else {
            $this->target = null;
            new SysmessageCommand($this->client, "Invalid target.");
            return false;
        }
    }
}
