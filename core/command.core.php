<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Command {
    /* Server variables */
    static $list = [
        'i' => [
            'minPlevel' => 6,
        ],
        'm' => [
            'minPlevel' => 6,
        ],
        'r' => [
            'minPlevel' => 6,
        ],
        'color' => [
            'minPlevel' => 2,
        ],
        'tele' => [
            'minPlevel' => 2,
        ],
        'invis' => [
            'minPlevel' => 4,
        ],
        'where' => [
            'minPlevel' => 1,
        ],
        'sysmessage' => [
            'minPlevel' => 2,
        ],
        'emote' => [
            'minPlevel' => 2,
        ],
        'sendpacket' => [
            'minPlevel' => 7,
        ],
        'info' => [
            'minPlevel' => 4,
        ],
        'sound' => [
            'minPlevel' => 2,
        ],
        'music' => [
            'minPlevel' => 2,
        ],
        'update' => [
            'minPlevel' => 2,
        ],
    ];

    static $commandAlias = [
        'add' => 'i',
        'addchar' => 'm',
        'remove' => 'r',
        'go' => 'tele',
        'sysm' => 'sysmessage',
        'hide' => 'invis',
    ];

    public function __construct() {
        foreach (glob(UltimaPHP::$basedir . 'core/commands/*.command.php') as $file) {
            if (!require_once ($file)) {
                UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_READ_FAIL, [$file]);
                UltimaPHP::stop();
            }
        }
    }

    public static function threatCommand($client = null, $command = null, $sentFrom = null, $ignorePlevel = false) {
        if ($client === null || $command === null) {
            return false;
        }

        $tmp = explode(" ", $command);
        $command = strtolower(substr($tmp[0], 1));

        $tmp = array_slice($tmp, 1);
        $args = (count($tmp) > 0 ? explode(",", implode(" ", $tmp)) : []);

        return self::runCommand($client, $command, $args, $sentFrom, $ignorePlevel);
    }

    public static function runCommand($client = null, $command = null, $args = [], $sentFrom = null, $ignorePlevel = false) {
        if ($client === null) {
            return false;
        }

        if (!isset($command)) {
            new SysmessageCommand($client, ["Sorry, but no command was received from client."]);
            return false;
        }

        if (isset(self::$commandAlias[$command])) {
            $command = self::$commandAlias[$command];
        }

        /* Check if there is an X before the command, meaning that the command will run in other player/object/mobile */
        if (!isset(self::$list[$command]) && substr($command, 0, 1) == "x") {
            new SysmessageCommand($client, ["Where do you want to execute this command?"]);
            UltimaPHP::$socketClients[$client]['account']->player->attachTarget($client, ['method' => "GeneralCommandCallback", 'args' => ['command' => substr($command, 1), 'args' => $args]]);
            return true;
        }

        if (!isset(self::$list[$command])) {
            new SysmessageCommand($client, ["Sorry, the command you are trying to run was not been found."]);
            return false;
        }

        if ($sentFrom !== null) {
            if (!$ignorePlevel && self::$list[$command]['minPlevel'] > UltimaPHP::$socketClients[$sentFrom]['account']->plevel) {
                new SysmessageCommand($client, ["Sorry, but you can't run this command, your account have no rights to do that."]);
                return false;
            }
        } else {
            if (!$ignorePlevel && self::$list[$command]['minPlevel'] > UltimaPHP::$socketClients[$client]['account']->plevel) {
                new SysmessageCommand($client, ["Sorry, but you can't run this command, your account have no rights to do that."]);
                return false;
            }
        }

        $cmd = ucfirst($command) . "Command";

        if (!class_exists($cmd)) {
            new SysmessageCommand($client, ["Sorry, something strange happend... the command exists, but no class found for it."]);
            return false;
        }

        new $cmd($client, $args);

        return true;
    }
}
