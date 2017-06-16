<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Account {
    /* Server variables */

    public $isValid = false;
    public $client;

    /* Account information variables */
    public $mongoId;
    public $serial;
    public $account;
    public $password;
    public $maxchars;
    public $creation_date;
    public $last_login;
    public $plevel;
    public $status;
    /* Account flags*/
    public $featuresFlags  = 0;
    public $charListFlags  = 0;
    public $tooltipEnabled = false;

    /* Character object array */
    public $characters = null;

    /* Logged player variables */
    public $player = null;

    /**
     * Looks for the account credentials in the database and define the base variables
     */
    public function __construct($account = null, $password = null, $client = null) {
        $this->client = $client;

        $result = UltimaPHP::$db->collection("accounts")->find(['account' => $account, 'password' => $password])->toArray();

        if (isset($result[0])) {
            $this->mongoId       = $result[0]['_id'];
            $this->serial        = $result[0]['serial'];
            $this->account       = $result[0]['account'];
            $this->password      = $result[0]['password'];
            $this->maxchars      = $result[0]['maxChars'];
            $this->creation_date = $result[0]['creationDate'];
            $this->last_login    = $result[0]['lastLogin'];
            $this->plevel        = $result[0]['plevel'];
            $this->status        = $result[0]['status'];
            $this->characters    = $this->getCharacterList();
            $this->isValid       = true;

            $this->updateFeaturesFlags();
            $this->updateCharListFlags();

            return $this;
        }
    }

    public function updateFeaturesFlags() {
        $this->featuresFlags = 0;

        if (UltimaPHP::$conf['features']['featuret2a'] & 0x01) {
            $this->featuresFlags |= 0x4;
        }

        if (UltimaPHP::$conf['features']['featuret2a'] & 0x02) {
            $this->featuresFlags |= 0x1;
        }

        if (UltimaPHP::$conf['features']['featurelbr'] & 0x01) {
            $this->featuresFlags |= 0x8;
        }

        if (UltimaPHP::$conf['features']['featurelbr'] & 0x02) {
            $this->featuresFlags |= 0x2;
        }

        if (UltimaPHP::$conf['features']['featureaos'] & 0x01) {
            $this->featuresFlags |= (0x10 | 0x8000);
        }

        if (UltimaPHP::$conf['features']['featurese'] & 0x01) {
            $this->featuresFlags |= 0x40;
        }

        if (UltimaPHP::$conf['features']['featureml'] & 0x01) {
            $this->featuresFlags |= 0x80;
        }

        if (UltimaPHP::$conf['features']['featuresa'] & 0x01) {
            $this->featuresFlags |= 0x10000;
        }

        if (UltimaPHP::$conf['features']['featuretol'] & 0x01) {
            $this->featuresFlags |= 0x400000;
        }

        if (UltimaPHP::$conf['accounts']['max_chars'] > 6) {
            $this->featuresFlags |= 0x1000;
        }

        if (UltimaPHP::$conf['accounts']['max_chars'] == 6) {
            $this->featuresFlags |= 0x20;
        }

        if (UltimaPHP::$conf['features']['featureextra'] & 0x01) {
            $this->featuresFlags |= 0x200;
        }

        if (UltimaPHP::$conf['features']['featureextra'] & 0x02) {
            $this->featuresFlags |= 0x40000;
        }

        if (UltimaPHP::$conf['features']['featureextra'] & 0x04) {
            $this->featuresFlags |= 0x80000;
        }

        if (UltimaPHP::$conf['features']['featureextra'] & 0x08) {
            $this->featuresFlags |= 0x100000;
        }

        if (UltimaPHP::$conf['features']['featureextra'] & 0x10) {
            $this->featuresFlags |= 0x200000;
        }

        // Only for KR or Enhanced
        // if ( m_NetState->isClientKR() || m_NetState->isClientEnhanced() ) {}
        if (UltimaPHP::$conf['features']['featureextra'] & 0x20) {
            $this->featuresFlags |= 0x2000;
        }
    }

    public function updateCharListFlags() {
        $this->charListFlags = 0;

        if (UltimaPHP::$conf['features']['featureaos'] & 0x02) {
            $this->charListFlags |= 0x20;
        }

        if (UltimaPHP::$conf['features']['featureaos'] & 0x04) {
            $this->charListFlags |= 0x08;
        }

        if (UltimaPHP::$conf['features']['featurese'] & 0x02) {
            $this->charListFlags |= 0x80;
        }

        if (UltimaPHP::$conf['features']['featureml'] & 0x01) {
            $this->charListFlags |= 0x100;
        }

        if (UltimaPHP::$conf['features']['featurekr'] & 0x01) {
            $this->charListFlags |= 0x200;
        }

        if (UltimaPHP::$conf['features']['featuresa'] & 0x02) {
            $this->charListFlags |= 0x4000;
        }

        if (UltimaPHP::$conf['accounts']['max_chars'] > 6) {
            $this->charListFlags |= 0x1000;
        } else if (UltimaPHP::$conf['accounts']['max_chars'] == 6) {
            $this->charListFlags |= 0x40;
        } else if (UltimaPHP::$conf['accounts']['max_chars'] == 1) {
            $this->charListFlags |= (0x10 | 0x4);
        }

        /* Disable the "overwrite configuration file" */
        $this->charListFlags |= 0x02;

        // if ( m_NetState->isClientKR() || m_NetState->isClientEnhanced() )       // tooltips must be always enabled on enhanced clients
        //     $charListFlags |= (0x400|0x200|0x20);

        $this->tooltipEnabled = ($this->charListFlags & 0x20 ? true : false);
    }

    /**
     * Send ping response to the client
     */
    public function sendPingResponse($runInLot = false) {
        $packet = "7301";
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Update the initial list of charactes in the account to show the character list
     */
    public function getCharacterList($updateList = false) {
        if ($updateList || $this->characters === null) {

            $result = UltimaPHP::$db->collection("players")->find(['account_serial' => $this->serial], ['projection' => ['player_serial' => true, 'name' => true]])->toArray();

            $chars = array();
            foreach ($result as $char) {
                $chars[] = array(
                    'player_serial' => $char['player_serial'],
                    'serial'        => (442500 + $char['player_serial']),
                    'name'          => $char['name'],
                );
            }

            return $chars;
        } else {
            return $this->characters;
        }
    }

    /**
     * Send the server list to the client
     */
    public function sendServerList($runInLot = false) {
        $packet    = "";
        $tmpPacket = "";
        foreach (UltimaPHP::$servers as $key => $server) {
            $ip = explode(".", $server['ip']);

            $tmpPacket .= str_pad(dechex(($key + 1)), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(Functions::strToHex($server['name']), 64, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(dechex($server['full']), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($server['timezone']), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($ip[3]), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($ip[2]), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($ip[1]), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($ip[0]), 2, "0", STR_PAD_LEFT);
        }

        $packet = "A8";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 6), 4, "0", STR_PAD_LEFT);
        $packet .= "FF";
        $packet .= str_pad(dechex(count(UltimaPHP::$servers)), 4, "0", STR_PAD_LEFT);
        $packet .= $tmpPacket;

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Enable locked client features
     */
    public function enableLockedFeatures($runInLot = false) {
        $packet = "B9";
        $packet .= str_pad(dechex($this->featuresFlags), 8, "0", STR_PAD_LEFT);
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the account characters list to the client
     */
    public function sendCharacterList($runInLot = false) {
        $characters        = $this->characters;
        $startingLocations = UltimaPHP::$starting_locations;

        $charLimit = 7;
        $tmpPacket = "";

        for ($i = 0; $i < $charLimit; $i++) {
            if ($i < count($characters)) {
                $tmpPacket .= str_pad((isset($characters[$i]) ? Functions::strToHex($characters[$i]['name']) : 0), 60, "0", STR_PAD_RIGHT);
                $tmpPacket .= str_pad("00", 60, "0", STR_PAD_RIGHT);
            } else {
                $tmpPacket .= str_pad("00", 120, "0", STR_PAD_RIGHT);
            }
        }
        $tmpPacket .= str_pad(dechex(count($startingLocations)), 2, "0", STR_PAD_LEFT);

        foreach ($startingLocations as $key => $location) {
            // If Client version is bigger then 7.0.13.0
            $tmpPacket .= str_pad(dechex($key + 1), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(Functions::strToHex($location['name'])), 64, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(strtoupper(Functions::strToHex($location['area'])), 64, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['x'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['y'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['z'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['map'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['clioc'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad("", 8, "0", STR_PAD_RIGHT);
        }

        $tmpPacket .= str_pad($this->charListFlags, 8, "0", STR_PAD_LEFT);
        $tmpPacket .= "FFFF";

        $packet = "A9";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 4), 4, "0", STR_PAD_LEFT);
        $packet .= "07";
        $packet .= $tmpPacket;

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Process the character login request
     */
    public function loginCharacter($slot = 0) {
        if (isset($this->characters[$slot])) {
            $this->player = new Player($this->client, $this->characters[$slot]);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "enableMapDiffs",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "sendClientLocaleBody",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "updateCursorColor",
                "args"   => $this->player->position['map'],
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "drawChar",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "drawPlayer",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "updateStatusBar",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "mountSpeed",
                "args"   => 0,
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "statusBarInfo",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "extendedStats",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "confirmLogin",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setWarMode",
                "args"   => 0,
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setSeasonal",
                "args"   => array(0, true),
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setWeather",
                "args"   => array(255, 0, 16),
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setLight",
                "args"   => 2,
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setTime",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "playMusic",
                "args"   => 29,
            ), 0.0, true, true);
        } else {
            $this->disconnect(4);
        }
    }

    /**
     * Send the connection confirmation of selected server
     */
    public function sendConnectionConfirmation($runInLot = false) {
        if (isset(UltimaPHP::$socketClients[$this->client]['connected_server'])) {
            $ip = explode(".", UltimaPHP::$servers[UltimaPHP::$socketClients[$this->client]['connected_server']]['ip']);

            $packet = "8C";
            $packet .= str_pad(dechex($ip[0]), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($ip[1]), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($ip[2]), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($ip[3]), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(UltimaPHP::$servers[UltimaPHP::$socketClients[$this->client]['connected_server']]['port']), 4, "0", STR_PAD_LEFT);

            $packet .= str_pad(dechex(UltimaPHP::$socketClients[$this->client]['version']['major']), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(UltimaPHP::$socketClients[$this->client]['version']['minor']), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(UltimaPHP::$socketClients[$this->client]['version']['revision']), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(UltimaPHP::$socketClients[$this->client]['version']['prototype']), 2, "0", STR_PAD_LEFT);

            Sockets::out($this->client, $packet, $runInLot);
        } else {
            $this->disconnect(4);
        }
    }

    /**
     * Disconnect account from server
     *
     * Reasons:
     * 0 - Incorrect namae/password.
     * 1 - Someone is already using this account.
     * 2 - Your account has been blocked.
     * 3 - Your account credentials are invalid.
     * 4 - Communication problem. [DEFAULT]
     * 5 - The IGR concurrency limit has been met.
     * 6 - The IGR time limit has been met.
     * 7 - General IGR authentication failure.
     */
    public function disconnect($reason = 4) {
        $packet = chr(130) . chr(hexdec($reason));
        UltimaPHP::log("Client " . UltimaPHP::$socketClients[$this->client]['ip'] . " disconnected from the server");
        Sockets::out($this->client, $packet, false, true, true);
    }

    public function sendClientVersionRequest($runInLot = false) {
        Sockets::out($this->client, "BD0003", $runInLot);
    }

    /**
     *
     * Create New Char New clientes > 7.0.20
     *
     * @return
     */
    public function createNewChar($info = []) {
        $statSum = $info['stats']['str'] + $info['stats']['dex'] + $info['stats']['int'];

        // Every stat needs to be below 60 && the sum lower/equal than 80
        if ($statSum > 90 || ($info['stats']['str'] > 60) || ($info['stats']['dex'] > 60) || ($info['stats']['int'] > 60)) {
            echo "Client sent invalid stats during character creation (" . $str . "," . $dex . "," . $int . ").\n";
            return false;
        }

        $position = [
            'x'       => $info['start']['position']['x'],
            'y'       => $info['start']['position']['y'],
            'z'       => $info['start']['position']['z'],
            'map'     => $info['start']['position']['map'],
            'facing'  => 3,
            'running' => false,
        ];

        $maxPets = 5;

        $dbLastSerial = UltimaPHP::$db->collection("players")->find([], ['projection' => ['player_serial' => true], 'sort' => ['player_serial' => -1], 'limit' => 1])->toArray();
        $nextSerial   = ((int) $dbLastSerial[0]['player_serial'] + 1);

        // Register the new char on the database
        $startingSkill = (float) UltimaPHP::$conf['accounts']['starting_skills'];
        $obj           = [
            'account'         => $this->mongoId,
            'account_serial'  => $this->serial,
            'player_serial'   => $nextSerial,
            'name'            => $info['name'],
            'body'            => $info['body'],
            'color'           => $info['color']['skin'],
            'sex'             => $info['sex'],
            'race'            => $info['race'],
            'position'        => $position,
            'skills'          => [
                "alchemy"       => $startingSkill,
                "anatomy"       => $startingSkill,
                "animallore"    => $startingSkill,
                "itemid"        => $startingSkill,
                "armslore"      => $startingSkill,
                "parrying"      => $startingSkill,
                "begging"       => $startingSkill,
                "blacksmith"    => $startingSkill,
                "bowcraft"      => $startingSkill,
                "peacemaking"   => $startingSkill,
                "camping"       => $startingSkill,
                "carpentry"     => $startingSkill,
                "cartography"   => $startingSkill,
                "cooking"       => $startingSkill,
                "detecthidden"  => $startingSkill,
                "enticement"    => $startingSkill,
                "evalint"       => $startingSkill,
                "healing"       => $startingSkill,
                "fishing"       => $startingSkill,
                "forensics"     => $startingSkill,
                "herding"       => $startingSkill,
                "hiding"        => $startingSkill,
                "provocation"   => $startingSkill,
                "inscription"   => $startingSkill,
                "lockpick"      => $startingSkill,
                "magery"        => $startingSkill,
                "magicresist"   => $startingSkill,
                "tactics"       => $startingSkill,
                "snooping"      => $startingSkill,
                "musicianship"  => $startingSkill,
                "poisoning"     => $startingSkill,
                "archery"       => $startingSkill,
                "spiritspeak"   => $startingSkill,
                "stealing"      => $startingSkill,
                "tailoring"     => $startingSkill,
                "taming"        => $startingSkill,
                "tasteid"       => $startingSkill,
                "tinkering"     => $startingSkill,
                "tracking"      => $startingSkill,
                "vet"           => $startingSkill,
                "swordsmanship" => $startingSkill,
                "macefighting"  => $startingSkill,
                "fencing"       => $startingSkill,
                "wrestling"     => $startingSkill,
                "lumberjack"    => $startingSkill,
                "mining"        => $startingSkill,
                "meditation"    => $startingSkill,
                "stealth"       => $startingSkill,
                "removetrap"    => $startingSkill,
                "necromancy"    => $startingSkill,
                "focus"         => $startingSkill,
                "chivalry"      => $startingSkill,
                "bushido"       => $startingSkill,
                "ninjitsu"      => $startingSkill,
                "spellweaving"  => $startingSkill,
                "mysticism"     => $startingSkill,
                "imbuing"       => $startingSkill,
                "throwing"      => $startingSkill,
            ],
            'hits'            => $info['stats']['str'],
            'maxhits'         => $info['stats']['str'],
            'mana'            => $info['stats']['int'],
            'maxmana'         => $info['stats']['int'],
            'stam'            => $info['stats']['dex'],
            'maxstam'         => $info['stats']['dex'],
            'str'             => $info['stats']['str'],
            'maxstr'          => $info['stats']['str'],
            'int'             => $info['stats']['int'],
            'maxint'          => $info['stats']['int'],
            'dex'             => $info['stats']['dex'],
            'maxdex'          => $info['stats']['dex'],
            'statscap'        => UltimaPHP::$conf['accounts']['statscap'],
            'pets'            => 0,
            'maxpets'         => $maxPets,
            'resist_physical' => 0,
            'resist_fire'     => 0,
            'resist_cold'     => 0,
            'resist_poison'   => 0,
            'resist_energy'   => 0,
            'luck'            => 0,
            'damage_min'      => 1,
            'damage_max'      => 4,
            'karma'           => 0,
            'fame'            => 0,
            'title'           => $info['title'],
        ];

        UltimaPHP::$db->collection("players")->insertOne($obj);
        UltimaPHP::log("New character " . $info['name'] . " (#" . $nextSerial . ") created for account: " . $this->account);

        // Update account instace characters
        $this->characters = $this->getCharacterList(true);
        // Send login request for new char
        $this->loginCharacter($info['slot']);
    }
}