<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
set_time_limit(0);
ini_set('memory_limit', '2048M');
ini_set('default_charset', 'UTF-8');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'core/server.php';
require_once 'core/functions.php';

$testMode = (isset($argv[1]) ? ($argv[1] == "test" ? true : false) : false);
$server = new UltimaPHP($testMode);
$server->start();