<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class UltimaPHP {
    /* Server Status */

    const STATUS_START                      = 0x00000;
    const STATUS_STOP                       = 0x00001;
    const STATUS_FATAL                      = 0x00002;
    const STATUS_FILE_READING               = 0x00004;
    const STATUS_FILE_READ_FAIL             = 0x00008;
    const STATUS_FILE_READED                = 0x00010;
    const STATUS_FILE_READ_IGNORE           = 0x00020;
    const STATUS_DATABASE_CONNECTING        = 0x00040;
    const STATUS_DATABASE_CONNECTED         = 0x00080;
    const STATUS_DATABASE_CONNECTION_FAILED = 0x00100;
    const STATUS_UNHANDLED                  = 0x00200;
    const STATUS_UNKNOWN                    = 0x00400;
    const STATUS_LISTENING                  = 0x00800;
    const STATUS_RUNNING                    = 0x01000;

    /* Server Log Types */
    const LOG_NORMAL  = "NORMAL";
    const LOG_WARNING = "WARNING";
    const LOG_DANGER  = "DANGER";
    const LOG_ERROR   = "ERROR";

    /* Server bitwise masks */
    const BITMASK_INDEX_MASK = 0x0FFFFFFF;
    const BITMASK_INDEX_FREE = 0x01000000;
    const BITMASK_UNUSED     = 0xFFFFFFFF;
    const BITMASK_CONTAINED  = 0x10000000;
    const BITMASK_EQUIPPED   = 0x20000000;
    const BITMASK_DISCONNECT = 0x30000000;
    const BITMASK_ITEM       = 0x40000000;
    const BITMASK_RESOURCE   = 0x0000000;

    /* Instances types */
    const INSTANCE_PLAYER = 0x00;
    const INSTANCE_OBJECT = 0x01;
    const INSTANCE_MOBILE = 0x02;

    /* Server Variables */
    static $status = self::STATUS_UNKNOWN;
    static $testMode;
    static $start_time;
    static $basedir;
    static $conf;
    static $servers = [];

    /* File Management Variables */
    static $files = [];

    /* Server Clients Sockets Variables */
    static $socketServer;
    static $socketClients = [];
    static $socketEvents  = [];

    /* Server Database Connection Variables */
    static $db;

    /* Shard Variables */
    static $starting_locations = array();
    static $clients            = 0;
    static $items              = 0;
    static $npcs               = 0;

    public function __construct($testMode = false) {
        self::$basedir = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR ;
        self::$testMode = $testMode;
    }

    public function start() {
        self::setStatus(self::STATUS_START);

        // Load the ini configuration file
        self::loadIni();

        // Load the core files
        $coreFiles  = glob(self::$basedir . "core/*.core.php");
        $totalFiles = count($coreFiles);

        foreach ($coreFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading core");

            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }

            $name      = basename($file, ".core.php");
            $className = ucfirst($name);
            $$name     = new $className();
        }

        // Load included classes
        $classFiles = glob(self::$basedir . "core/*.class.php");
        $totalFiles = count($classFiles);
        foreach ($classFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading classes");
            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }
        }

        // Load the packets files
        $coreFiles  = glob(self::$basedir . "core/packets/*.packet.php");
        $totalFiles = count($coreFiles);

        foreach ($coreFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading packets");

            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }
        }

        // Load Skills
        $skillFiles = glob(self::$basedir . "core/skills/*.skill.php");
        $totalFiles = count($skillFiles);
        foreach ($skillFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading skills");
            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }
        }

        // Load Systems
        $sysFiles = glob(self::$basedir . "core/systems/uostore/*.sys.php");
        $totalFiles = count($sysFiles);
        foreach ($sysFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading systems");
            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }
        }

        // Load definitions
        $defFiles   = glob(self::$basedir . "core/defs/*.def.php");
        $totalFiles = count($defFiles);
        foreach ($defFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading definitions");
            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }
        }

        // Load types
        $defFiles   = glob(self::$basedir . "core/types/*.type.php");
        $totalFiles = count($defFiles);
        foreach ($defFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading types");
            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }
        }

        // Load AI
        $defFiles   = glob(self::$basedir . "core/AI/*.ai.php");
        $totalFiles = count($defFiles);
        foreach ($defFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading artificial intelligence");
            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }
        }

        // Load gumps
        $defFiles   = glob(self::$basedir . "scripts/gumps/*.gump.php");
        $totalFiles = count($defFiles);
        foreach ($defFiles as $fileCount => $file) {
            Functions::progressBar($fileCount + 1, $totalFiles, "Loading gumps");
            if (!require_once ($file)) {
                self::setStatus(self::STATUS_FILE_READ_FAIL, [$file]);
                self::stop();
            }
        }

        // Load scripts
        $scripts      = Functions::rglob(self::$basedir . DIRECTORY_SEPARATOR . self::$conf['scripts']['load'] . DIRECTORY_SEPARATOR . "*.php");
        $scriptsTotal = count($scripts);
        foreach ($scripts as $scriptKey => $file) {
            Functions::progressBar($scriptKey + 1, $scriptsTotal, "Loading scripts");

            if (class_exists(pathinfo($file, PATHINFO_FILENAME))) {
                self::setStatus(self::STATUS_FILE_READ_IGNORE, [$file]);
            } else {
                require_once $file;
            }
        }

        Map::readTiledata();
        Map::readMaps();

        self::setStatus(self::STATUS_DATABASE_CONNECTING);
        try {
            self::$db = new Mongodb();
            self::setStatus(self::STATUS_DATABASE_CONNECTED);
        } catch (Exception $e) {
            self::setStatus(self::STATUS_DATABASE_CONNECTION_FAILED, array(
                "\n" . $e->getMessage(),
            ));
        }

        /* Update starting location list */
        self::updateStartingLocations();

        /* Load map objects */
        Map::readObjects();
        
        /* Load map mobiles */
        Map::readMobiles();

        self::setStatus(self::STATUS_RUNNING, array(
            self::$conf['server']['ip'],
            self::$conf['server']['port'],
        ));

        /* Kill server after start for CI Building */
        if (getenv("CI_BUILD"))
            exit(0);

        while (self::STATUS_FATAL != self::$status && self::STATUS_STOP != self::$status) {
            Sockets::monitor();
            Sockets::runEvents();
        }
    }

    public static function stop() {
        if (self::$status != self::STATUS_STOP) {
            self::setStatus(self::STATUS_STOP);
        }
        exit(1);
    }

    private static function loadIni() {
        if (!is_file(self::$basedir . "ultimaphp.ini")) {
            self::setStatus(self::STATUS_FILE_READ_FAIL, ["ultimaphp.ini"]);
            self::stop();
        }

        self::$conf = array_change_key_case(parse_ini_file(self::$basedir . "ultimaphp.ini", true), CASE_LOWER);

        // Ini validations
        if (!isset(self::$conf['server'])) {
            $iniMessage = "No [server] configuration section";
        } elseif (!isset(self::$conf['mongodb'])) {
            $iniMessage = "No [mongodb] configuration section";
        } elseif (!isset(self::$conf['accounts'])) {
            $iniMessage = "No [accounts] configuration section";
        } elseif (!isset(self::$conf['logs'])) {
            $iniMessage = "No [logs] configuration section";
        } elseif (!isset(self::$conf['server']['name'])) {
            $iniMessage = "Server name not defined";
        } elseif (!isset(self::$conf['server']['ip'])) {
            $iniMessage = "Server ip not defined";
        } elseif (!isset(self::$conf['server']['port'])) {
            $iniMessage = "Server port not defined";
        } elseif (!isset(self::$conf['server']['timezone'])) {
            $iniMessage = "Server timezone not defined";
            $iniNote    = "More information at: https://en.wikipedia.org/wiki/List_of_tz_database_time_zones";
        } elseif (!isset(self::$conf['server']['lang'])) {
            $iniMessage = "Server language not defined";
        } elseif (!isset(self::$conf['server']['save_time'])) {
            $iniMessage = "Server save time not defined";
        } elseif (!isset(self::$conf['server']['client'])) {
            $iniMessage = "Server client not defined";
        } elseif (!isset(self::$conf['mongodb']['URI'])) {
            if (!isset(self::$conf['mongodb']['host'])) {
                $iniMessage = "Server mongodb host not defined";
            } elseif (!isset(self::$conf['mongodb']['port'])) {
                $iniMessage = "Server mongodb port not defined";
            }
        } elseif (!isset(self::$conf['mongodb']['database'])) {
            $iniMessage = "Server mongodb database not defined";
        } elseif (!isset(self::$conf['accounts']['auto_create'])) {
            $iniMessage = "Server accounts auto create not defined";
        } elseif (!isset(self::$conf['accounts']['max_chars'])) {
            $iniMessage = "Server accounts maximum characters per account not defined";
        } elseif (!isset(self::$conf['accounts']['char_delete_time'])) {
            $iniMessage = "Server accounts character deletion minimum time not defined";
        } elseif (!isset(self::$conf['accounts']['login_tries'])) {
            $iniMessage = "Server accounts login tries not defined";
        } elseif (!isset(self::$conf['accounts']['login_tries_block_time'])) {
            $iniMessage = "Server accounts login tries block time not defined";
        } elseif (!isset(self::$conf['accounts']['allow_crypt'])) {
            $iniMessage = "Server accounts allow crypt not defined";
        } elseif (!isset(self::$conf['accounts']['allow_nocrypt'])) {
            $iniMessage = "Server accounts allow nocrypt not defined";
        } elseif (!isset(self::$conf['accounts']['ConnectingMaxIp'])) {
            $iniMessage = "Server accounts maximum connection per ip not defined";
        } elseif (!isset(self::$conf['logs']['debug'])) {
            $iniMessage = "Server logs debug not defined";
        }

        $ip = explode(".", self::$conf['server']['ip']);

        if (count($ip) > 4 || count($ip) < 4) {
            $iniMessage = "The defined server IP is not valid";
        } else {
            foreach ($ip as $key => $value) {
                if (!(int) $value && "0" !== $value) {
                    $iniMessage = "The defined server IP is not valid";
                    break;
                } elseif ($value > 255) {
                    $iniMessage = "The defined server IP is not valid";
                    break;
                } elseif ($value < 0) {
                    $iniMessage = "The defined server IP is not valid";
                    break;
                }
            }
        }

        // Update the debug variable
        self::$conf['logs']['debug'] = (bool) self::$conf['logs']['debug'];

        if (isset($iniMessage)) {
            self::log($iniMessage . " in ultimaphp.ini.", self::LOG_ERROR);
            if (isset($iniNote)) {
                self::log($iniNote, self::LOG_NORMAL);
            }
            self::stop();
        }

        self::$servers[] = array(
            'name'     => UltimaPHP::$conf['server']['name'],
            'ip'       => UltimaPHP::$conf['server']['ip'],
            'port'     => UltimaPHP::$conf['server']['port'],
            'full'     => (0 == UltimaPHP::$conf['server']['max_players'] ? 0 : ceil((UltimaPHP::$clients / UltimaPHP::$conf['server']['max_players']) * 100)),
            'timezone' => UltimaPHP::$conf['server']['timezone'],
        );
    }

    public static function setStatus($status, $args = array()) {
        switch ($status) {
        case self::STATUS_START:
            $message = "Starting server";
            $type    = self::LOG_NORMAL;
            break;

        case self::STATUS_STOP:
            $message  = "Stoping server";
            $type     = self::LOG_NORMAL;
            $shutdown = true;
            break;

        case self::STATUS_FATAL:
            $message  = "Server crashed suddenly";
            $type     = self::LOG_DANGER;
            $shutdown = true;
            break;

        case self::STATUS_FILE_READING:
            $message = "Loading file: " . $args[0];
            $type    = self::LOG_NORMAL;
            break;

        case self::STATUS_FILE_READ_FAIL:
            $message = "Loading file " . (isset($args[0]) ? $args[0] . " " : "") . "failed!";
            if (isset($args[1])) {
                $message .= " ({$args[1]})";
            }
            $type    = self::LOG_DANGER;
            break;

        case self::STATUS_FILE_READED:
            $message = null;
            $type    = self::LOG_NORMAL;
            break;

        case self::STATUS_FILE_READ_IGNORE:
            $message = "Can't load file, the class name is already taken" . (isset($args[0]) ? " (" . $args[0] . ")" : "");
            $type    = self::LOG_WARNING;
            break;

        case self::STATUS_DATABASE_CONNECTING:
            $message = "Trying to connect to the database";
            $type    = self::LOG_NORMAL;
            break;

        case self::STATUS_DATABASE_CONNECTED:
            $message = "Database connected successfully";
            $type    = self::LOG_NORMAL;
            break;

        case self::STATUS_DATABASE_CONNECTION_FAILED:
            $message  = "Server could not connect to the database with error: " . $args[0];
            $type     = self::LOG_DANGER;
            $shutdown = true;
            break;

        case self::STATUS_UNKNOWN:
            $message = "Unknown status set";
            $type    = self::LOG_WARNING;
            break;

        case self::STATUS_LISTENING:
            $type = self::LOG_NORMAL;
            break;

        case self::STATUS_RUNNING:
            $message = "Server is running on " . $args[0] . " at port " . $args[1];
            $type    = self::LOG_NORMAL;
            break;

        default:
            $message = "Wrong status set. restoring last status.";
            $type    = self::LOG_DANGER;
            $status  = self::$status;
            break;
        }

        self::$status = $status;

        if (isset($message)) {
            self::log($message, $type);
        }

        if (isset($shutdown)) {
            self::stop();
        }
    }

    public static function log($message = null, $type = "NORMAL") {
        if (null !== $message && null !== $type) {
            echo date("H:i:s") . (self::LOG_NORMAL != $type ? " (" . $type . ") " : "") . ": " . $message . "\n";
        }
    }

    public static function updateStartingLocations() {
        self::$starting_locations = self::$db->collection("server_starting_locations")->find([])->toArray();
        return true;
    }

}
