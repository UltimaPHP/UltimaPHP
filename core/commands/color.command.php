<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class ColorCommand extends Command {
    public function __construct($client, $args = []) {
        if ($client === null) {
            return false;
				}

        if (count($args) == 1) {
						new SysmessageCommand($client, ["What do you want to paint?"]);
						array_unshift($args, 'color');
            UltimaPHP::$socketClients[$client]['account']->player->attachTarget($client, ['method' => "ObjectCommandCallback", 'args' => $args]);
            return true;
        }

				$color = $args[0];
				$target = $args[1];

        if ($color === null) {
            new SysmessageCommand($client, ["Sorry, information is missing. The default is \"color\"."]);
            return false;
        }

        if ($target === null || $target == "00000000") {
            new SysmessageCommand($client, ["Sorry, but the map you'r trying to go doesn't exists."]);
            return false;
        }

				$instance = Map::getBySerial($target);
				$instance->color = intval($color);
				$instance->save();
				//validar se o item está no range ou na bag
				if ($instance->holder !== null) {
					$holder = Map::getBySerial($instance->holder);

					if ($holder->instanceType == UltimaPHP::INSTANCE_OBJECT) {
						$holder->addItemToOpenedContainer($client, $instance);
						return true;
					}
				}
				else {
					UltimaPHP::$socketClients[$client]['account']->player->update();
				}
        return true;
    }
}
