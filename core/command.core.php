<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Command {
	/* Server variables */
	static $list = array(
        'i' => array(
            'minPlevel' => 6
        ),
        'tele' => array(
            'minPlevel' => 2
        ),
        'go' => array(
            'minPlevel' => 2
        ),
        'invis' => array(
            'minPlevel' => 4
        ),
        'where' => array(
            'minPlevel' => 1
        ),
        'sysmessage' => array(
            'minPlevel' => 2
        ),
        'sysm' => array(
            'minPlevel' => 2
        ),
    );

	static $commandAlias = [
		'go' => 'tele',
		'sysm' => 'sysmessage',
		'hide' => 'invis',
	];

    public function __construct() {
    	foreach (glob(UltimaPHP::$basedir . 'core/commands/*.command.php') as $file) {
            UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_LOADING, array(
                "core/" . basename($file),
            ));

            if (!require_once ($file)) {
                UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_LOAD_FAIL);
                UltimaPHP::stop();
            }

            UltimaPHP::setStatus(UltimaPHP::STATUS_FILE_LOADED);
        }
    }

	public static function threatCommand($client = null, $command = null) {
		if ($client === null || $command === null) {
			return false;
		}

		$tmp = explode(" ", $command);
		$command = strtolower(substr($tmp[0],1));

		$tmp = array_slice($tmp, 1);
		$args = (count($tmp) > 0 ? explode(",", implode(" ", $tmp)) : []);

        self::runCommand($client, $command, $args);
	}

	public static function runCommand($client = null, $command = null, $args = []) {
		if ($client === null) {
			return false;
		}

		if (isset(self::$commandAlias[$command])) {
        	$command = self::$commandAlias[$command];
        }

        if (UltimaPHP::$socketClients[$client]['account']->plevel > 1 && !isset($command)) {
            new SysmessageCommand($client, ["Sorry, but no command was received from client."]);
            return false;
        }

        if (!isset(self::$list[$command])) {
            new SysmessageCommand($client, ["Sorry, the command you are trying to run was not been found."]);
            return false;
        }

        if (self::$list[$command]['minPlevel'] > UltimaPHP::$socketClients[$client]['account']->plevel) {
            new SysmessageCommand($client, ["Sorry, but you can't run this command, your account have no rights to do that."]);
            return false;
        }

        $cmd  = ucfirst($command)."Command";

        if (!class_exists($cmd)) {
        	new SysmessageCommand($client, ["Sorry, something strange happend... the command exists, but no class found for it."]);
            return false;	 
        }

        new $cmd($client, $args);
        
        return true;
    }
}