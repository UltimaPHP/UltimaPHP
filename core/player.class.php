<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Player {
    /* Server variables */
    public $client;
    public $instanceType = UltimaPHP::INSTANCE_PLAYER;

    /* Temporary Variables */
    public $lastMove;
    public $forceUpdate = false;

    /* Player variables */
    public $id;
    public $serial;
    public $name;
    public $body;
    public $color;
    public $sex;
    public $layers;
    // Flags -- init
    public $frozen;
    public $female;
    public $flying;
    public $yellowHealthBar;
    public $ignoreMobiles;
    public $warmode;
    public $hidden;
    public $paralyzed;
    public $blessed;
    // Flags -- end
    public $race;
    public $position;
    public $hits;
    public $maxhits;
    public $mana;
    public $maxmana;
    public $stam;
    public $maxstam;
    public $str;
    public $maxstr;
    public $int;
    public $maxint;
    public $dex;
    public $maxdex;
    public $statscap;
    public $pets;
    public $maxpets;
    public $resist_physical;
    public $resist_fire;
    public $resist_cold;
    public $resist_poison;
    public $resist_energy;
    public $luck;
    public $render_range;
    public $damage_min;
    public $damage_max;
    public $karma;
    public $fame;
    public $title;
    public $skills = [];

    /* Temporary Variables */
    public $mapRange = [];

    public function __construct($client = null, $character_serial = null) {
        if (null === $client || null === $character_serial) {
            return false;
        }

        $this->client       = $client;
        $this->serial       = str_pad($character_serial, 8, "0", STR_PAD_LEFT);
        $this->id           = ($character_serial - 442500);
        $this->render_range = UltimaPHP::$conf['muls']['render_range'];

        $query = "SELECT
                        a.id,
                        a.name,
                        a.body,
                        a.color,
                        a.sex,
                        a.race,
                        a.position,
                        a.hits,
                        a.maxhits,
                        a.mana,
                        a.maxmana,
                        a.stam,
                        a.maxstam,
                        a.str,
                        a.maxstr,
                        a.int,
                        a.maxint,
                        a.dex,
                        a.maxdex,
                        a.statscap,
                        a.pets,
                        a.maxpets,
                        a.resist_physical,
                        a.resist_fire,
                        a.resist_cold,
                        a.resist_poison,
                        a.resist_energy,
                        a.luck,
                        a.damage_min,
                        a.damage_max,
                        a.karma,
                        a.fame,
                        a.title
                    FROM
                        players a
                    WHERE
                        a.id = :player_id";

        $sth = UltimaPHP::$db->prepare($query);
        $sth->execute(array(
            ":player_id" => $this->id,
        ));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (isset($result[0])) {
            $position = explode(",", $result[0]['position']);

            $this->name     = $result[0]['name'];
            $this->body     = $result[0]['body'];
            $this->color    = $result[0]['color'];
            $this->sex      = $result[0]['sex'];
            $this->race     = $result[0]['race'];
            $this->position = [
                'x'       => $position[0],
                'y'       => $position[1],
                'z'       => $position[2],
                'map'     => $position[3],
                'facing'  => 6,
                'running' => 0,
            ];
            $this->hits            = $result[0]['hits'];
            $this->maxhits         = $result[0]['maxhits'];
            $this->mana            = $result[0]['mana'];
            $this->maxmana         = $result[0]['maxmana'];
            $this->stam            = $result[0]['stam'];
            $this->maxstam         = $result[0]['maxstam'];
            $this->str             = $result[0]['str'];
            $this->maxstr          = $result[0]['maxstr'];
            $this->int             = $result[0]['int'];
            $this->maxint          = $result[0]['maxint'];
            $this->dex             = $result[0]['dex'];
            $this->maxdex          = $result[0]['maxdex'];
            $this->statscap        = $result[0]['statscap'];
            $this->pets            = $result[0]['pets'];
            $this->maxpets         = $result[0]['maxpets'];
            $this->resist_physical = $result[0]['resist_physical'];
            $this->resist_fire     = $result[0]['resist_fire'];
            $this->resist_cold     = $result[0]['resist_cold'];
            $this->resist_poison   = $result[0]['resist_poison'];
            $this->resist_energy   = $result[0]['resist_energy'];
            $this->luck            = $result[0]['luck'];
            $this->damage_min      = $result[0]['damage_min'];
            $this->damage_max      = $result[0]['damage_max'];
            $this->karma           = $result[0]['karma'];
            $this->fame            = $result[0]['fame'];
            $this->title           = $result[0]['title'];
            $this->warmode         = false;

            $query = "SELECT
                        a.id,
                        a.player,
                        a.alchemy,
                        a.anatomy,
                        a.animallore,
                        a.itemid,
                        a.armslore,
                        a.parrying,
                        a.begging,
                        a.blacksmith,
                        a.bowcraft,
                        a.peacemaking,
                        a.camping,
                        a.carpentry,
                        a.cartography,
                        a.cooking,
                        a.detecthidden,
                        a.enticement,
                        a.evalint,
                        a.healing,
                        a.fishing,
                        a.forensics,
                        a.herding,
                        a.hiding,
                        a.provocation,
                        a.inscription,
                        a.lockpick,
                        a.magery,
                        a.magicresist,
                        a.tactics,
                        a.snooping,
                        a.musicianship,
                        a.poisoning,
                        a.archery,
                        a.spiritspeak,
                        a.stealing,
                        a.tailoring,
                        a.taming,
                        a.tasteid,
                        a.tinkering,
                        a.tracking,
                        a.vet,
                        a.swordsmanship,
                        a.macefighting,
                        a.fencing,
                        a.wrestling,
                        a.lumberjack,
                        a.mining,
                        a.meditation,
                        a.stealth,
                        a.removetrap,
                        a.necromancy,
                        a.focus,
                        a.chivalry,
                        a.bushido,
                        a.ninjitsu,
                        a.spellweaving,
                        a.mysticism,
                        a.imbuing,
                        a.throwing
                    FROM
                        players_skills a
                    WHERE
                        a.player = :player_id";

            $sth = UltimaPHP::$db->prepare($query);
            $sth->execute(array(
                ":player_id" => $this->id,
            ));
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            if (isset($result[0])) {
                foreach ($result[0] as $skill => $value) {
                    if (in_array($skill, ['id', 'player'])) {
                        continue;
                    }

                    $skillclass = "Skill".ucfirst($skill);
                    $skilldef = "SkillsDefs::SKILL_" . strtoupper($skill);

                    if (class_exists($skillclass)) {
                        $this->skills[constant($skilldef)] = new $skillclass((float)$value);
                    } else {
                        UltimaPHP::log("Trying to set $skilldef to player  " . $this->name . " (".$this->serial.")", "ERROR");
                    }
                }
            }

            /* Define player layers */
            for ($i=1; $i<=31; $i++) {
                $this->layers[$i] = ($i == 30 ? [] : null);
            }

            /* Get player equipment from database*/
            // $query = "SELECT
            //             a.id,
            //             a.player,
            //             a.layer,
            //             a.itemSerial";
            // $sth = UltimaPHP::$db->prepare($query);
            // $sth->execute(array(
            //     ":player_id" => $this->id,
            // ));
            // $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            // if (count($result) > 0) {
            // }

            return true;
        }
        UltimaPHP::$socketClients[$this->client]['account']->disconnect();
        return false;
    }

    public function setName($newName = false, $client = false) {
        if (!$newName) {
            return false;
        }

        $this->name = $newName;

        if (!$client) {
            return true;
        }

        return $this->drawChar();
        return $this->updateStatusBar();
    }

    public function click($serial = null) {
        if ($serial === null) {
            return false;
        }

        if (hexdec($serial) & UltimaPHP::BITMASK_ITEM) {
            $item = Map::getBySerial($serial);
            if ($item) {
                $item->click($this->client);
            }
        }
    }

    public function dclick($serial = null) {
        if ($serial === null) {
            return false;
        }

        if (hexdec($serial) & 0x80000000) {
            $serial = dechex(hexdec($serial) - 0x80000000);
        }

        $instance = Map::getBySerial($serial);

        if (!$instance) {
            return false;
        }


        if ($this->serial == $instance->serial) {
            return $this->openPaperdoll($serial, true);
        } else if ($instance->instanceType == UltimaPHP::INSTANCE_PLAYER) {
            return $this->openPaperdoll($serial, (UltimaPHP::$socketClients[$this->client]['account']->plevel > 1 ? true : false));
        } else if ($instance->instanceType == UltimaPHP::INSTANCE_MOBILE) {
            // TODO: Detect if it's a humanoid mobile, if yes: open paperdoll
        } else if ($instance->instanceType == UltimaPHP::INSTANCE_OBJECT) {
            return $instance->dclick($this->client);
        }

        return false;
    }

	// A ser implementado    
    public function equipRequest($serial = null, $layer = null, $container = null) {
        if ($serial === null || $layer === null) {
            return false;
        }

        // Self equip
        if ($container == $this->serial) {
            // Something is already on the layer?
            if ($this->layers[hexdec($layer)] !== null) {
                // Unequip the item before equip new
            }

            if ($this->layers[LayersDefs::DRAGGING] !== null && $this->layers[LayersDefs::DRAGGING]->serial == $serial) {
                $instance = $this->layers[LayersDefs::DRAGGING];

                /* Clear draggin layer */
                $this->layers[LayersDefs::DRAGGING] = null;
            } else {
                $instance = Map::getBySerial($serial);
            }

            $this->layers[hexdec($layer)] = $instance;
            $this->forceUpdate = true;
            $this->drawChar();

            /* Removes from everyone view range */
            Map::removeSerialData($serial);
            Map::updateChunk(null, $this->client);
            return true;
        }

        $container = Map::getBySerial($container);

        if ($container === false) {
            return false;
        }

        if ($container->instanceType == UltimaPHP::INSTANCE_PLAYER) {
            if (UltimaPHP::$socketClients[$this->client]['account']->plevel > UltimaPHP::$socketClients[$container->client]['account']->plevel) {
                if ($container->layers[hexdec($layer)] !== null) {
                    // Unequip the item before equip new
                }

                if ($this->layers[LayersDefs::DRAGGING] !== null && $this->layers[LayersDefs::DRAGGING]->serial == $serial) {
                    $instance = $this->layers[LayersDefs::DRAGGING];

                    /* Clear draggin layer */
                    $this->layers[LayersDefs::DRAGGING] = null;
                } else {
                    $instance = Map::getBySerial($serial);
                }

                $container->layers[hexdec($layer)] = $instance;
                $container->forceUpdate = true;
                $container->drawChar();

                /* Removes from everyone view range */
                Map::removeSerialData($serial);
                Map::updateChunk(null, $this->client);
                return true;
            }

            new SysmessageCommand($client, ["Sorry, you have no privileges to change this player equipment."]);
            return false;
        }

        if ($container->instanceType == UltimaPHP::INSTANCE_MOBILE) {
            if (UltimaPHP::$socketClients[$this->client]['account']->plevel > 1) {
                echo "Trying to equip some mobile\n";
                return true;
            }

            new SysmessageCommand($client, ["Sorry, you have no privileges to change this mobile equipment."]);
            return false;
        }
    }
    
	/**
     * Send the client drop accept - A ser testado 
     */
    public function dropAccept($runInLot = false) {
        $packet = "29";
        Sockets::out($this->client, $packet, $runInLot);
    }

    public function dropItem($serial = null, $position = null, $grid = null, $container = null) {
        if ($serial === null || $position === null || $grid === null || $container === null) {
            return false;
        }

        if ($this->layers[LayersDefs::DRAGGING] !== null && $this->layers[LayersDefs::DRAGGING]->serial == $serial) {
            Map::addObjectToMap($this->layers[LayersDefs::DRAGGING], $position['x'], $position['y'], $position['z'], $this->position['map']);
        } else {
            echo "Dropping other item on $container\n";
        }

        $this->dropAccept();
        return true;
    }

    public function pickUp($serial = null, $amount = 1) {
        if ($serial === null) {
            return false;
        }

        $instance = Map::getBySerial($serial);
        if (!$instance) {
            return false;
        }

        if ($instance->amount < $amount) {
            return false;
        }

        if ($instance->amount > $amount) {
            // echo "Picking some part of the item stack\n";
            // update item amount
            // $instance->amount = ($instance->amount - $amount);

            // // Duplicate the item
            // $class = get_class($instance);

            // $newItem = new $$class();
            // $newItem->amount = $amount;

            // $this->layers[LayersDefs::DRAGGING] = $newItem;
        } else {
            Map::removeSerialData($serial);
            $this->layers[LayersDefs::DRAGGING] = $instance;

            $packet = "1D" . str_pad($serial, 8, "0", STR_PAD_LEFT);
            Map::sendPacketRange($packet, $this->client);
        }

        /* Removes from everyone view range */
        // Map::updateChunkForced($this->position);
    }

    public function openPaperdoll($serial, $canLift) {
        if ($serial == $this->serial) {
            $instance = $this;
        } else {
            $instance = Map::getBySerial($serial);
        }

        if (!$instance) {
                return false;
            }

        $packet = "88";
        $packet .= str_pad($instance->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(Functions::strToHex(trim($instance->name) . ($instance->title !== null ? ", " . trim($instance->title) : "")), 120, "0", STR_PAD_RIGHT);

        $flags = 0x00;

		if($instance->warmode) {
			$flags |= 0x01;
		}

        // Can alter paperdoll
        if ($canLift) {
            $flags |= 0x02;
        }

        $packet .= str_pad(hexdec($flags), 2, "0", STR_PAD_LEFT);
        Sockets::out($this->client, $packet, false);

        return true;
    }

    public function speech($type, $color, $font, $language, $text) {
        if (substr($text, 0, 1) == UltimaPHP::$conf['server']['commandPrefix']) {
            Command::threatCommand($this->client, $text);
            return true;
        }

        if (dechex($type) == 0x06) {
            $tmpPacket = Functions::strToHex($text);
            $packet    = "1C";
            $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 45), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad((dechex($type) == 0x06 ? "FFFFFFFF" : $this->serial), 8, "0", STR_PAD_LEFT);
            $packet .= str_pad((dechex($type) == 0x06 ? "FFFF" : dechex($this->body)), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($type), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($color), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($font), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(Functions::strToHex($this->name), 60, "0", STR_PAD_RIGHT);
            $packet .= $tmpPacket;
            $packet .= "00";
        } else {
            $tmpPacket = Functions::strToHex($text, true);
            $packet    = "AE";
            $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 50), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($type), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($color), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($font), 4, "0", STR_PAD_LEFT);
            $packet .= Functions::strToHex($language);
            $packet .= str_pad(Functions::strToHex($this->name), 60, "0", STR_PAD_RIGHT);
            $packet .= $tmpPacket;
            $packet .= "0000";

            Map::sendPacketRange($packet, $this->client);
        }
        Sockets::out($this->client, $packet, false);
    }
    
    /**
     * Send to the client the locale and body information
     */
    public function sendClientLocaleBody($runInLot = false) {
        $body_type = $this->body;
        $pos       = array(
            'x'      => $this->position['x'],
            'y'      => $this->position['y'],
            'z'      => $this->position['z'],
            'map'      => $this->position['map'],
            'facing' => $this->position['facing'],
        );
        $mapInfo = explode(",", UltimaPHP::$conf['muls']["map".$this->position['map']]);
        $map_size = array(
            'x' => $mapInfo[0] - 8,
            'y' => $mapInfo[1],
        );
        $packet = "1B";
        $packet .= $this->serial;
        $packet .= "00000000";
        $packet .= str_pad(dechex($body_type), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($pos['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($pos['y']), 4, "0", STR_PAD_LEFT);
        $packet .= "00";
        $packet .= Functions::toChar8($pos['z']);
        $packet .= str_pad(dechex($pos['facing']), 2, "0", STR_PAD_LEFT);
        // $packet .= "FFFFFFFF";
        $packet .= "00000000";
        $packet .= "00000000";
        $packet .= "00";
        $packet .= str_pad(dechex($map_size['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($map_size['y']), 4, "0", STR_PAD_LEFT);
        $packet .= "000000000000";
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the skills information to the client
     */
    public function sendFullSkillList($runInLot = false) {
        $tmpPacket = "02";
        
        foreach ($this->skills as $skill_id => $skillInfo) {
            $tmpPacket .= str_pad(dechex($skill_id+1), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($skillInfo->value*10), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($skillInfo->value*10), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= "00";
            $tmpPacket .= str_pad(dechex(((float)UltimaPHP::$conf['accounts']['skillcap']) * 10), 4, "0", STR_PAD_LEFT);
        }
        $tmpPacket .= "0000";

        $packet = "3A";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 3), 4, "0", STR_PAD_LEFT);
        $packet .= $tmpPacket;

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Update the cursor color of the client / Send map change info ???
     *
     * 0 = default
     * 1 = golden
     * 2 = ILSHENAR color? seems to be the map id...
     *
     */
    public function updateCursorColor($runInLot = false, $color = 0) {
        $packet = "BF00060008" . str_pad(dechex($color), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the information to client enable map diffs
     */
    public function enableMapDiffs($runInLot = false) {
        $maps = count(Map::$maps);

        $packet = "0018";
        $packet .= str_pad(dechex($maps), 4, "0", STR_PAD_LEFT);

        for ($i=0; $i <= ($maps-1); $i++) { 
            $packet .= "00000000";
            $packet .= "00000000";
        }

        $packet = "BF" . str_pad(dechex((strlen($packet) /2) + 3), 4, "0", STR_PAD_LEFT) . $packet;
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the client start to play music
     */
    public function playMusic($runInLot = false, $music = null) {
        if (null === $music) {
            return false;
        }

        $packet = "6D" . str_pad(dechex($music), 4, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the weather information to the client
     *
     * 0 = It starts to rain
     * 1 = A fierce storm approaches
     * 2 = It begins to snow
     * 3 = A storm is brewing
     * 254 = None (no effect? set temperature?)
     * 255 = None (Turns off sound)
     *
     */
    public function setWeather($runInLot = false, $args = array()) {
        $weather     = (isset($args[0]) ? $args[0] : null);
        $effect      = (isset($args[1]) ? $args[1] : 0);
        $temperature = (isset($args[2]) ? $args[2] : 16);

        if (null === $weather) {
            return false;
        }

        $packet = "65" . str_pad(dechex($weather), 2, "0", STR_PAD_LEFT) . str_pad(dechex($effect), 2, "0", STR_PAD_LEFT) . str_pad(dechex($temperature), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send seasonal information to the client
     *
     * 0 = Spring
     * 1 = Summer
     * 2 = Fall
     * 3 = Winter
     * 4 = Desolation
     *
     */
    public function setSeasonal($runInLot = false, $args = array()) {
        $season    = (isset($args[0]) ? $args[0] : 0);
        $playSound = (isset($args[1]) ? $args[1] : false);

        $packet = "BC" . str_pad(dechex($season), 2, "0", STR_PAD_LEFT) . str_pad(dechex((int) $playSound), 2, "0", STR_PAD_LEFT);
        
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the light level to the client
     * 0 = day
     * 9 = OSI night
     * 31 - Black (Max val)
     */
    public function setLight($runInLot = false, $level = 0) {
        if ($level < 0) {
            $level = 0;
        }

        if ($level > 31) {
            $level = 31;
        }

        $packet = "4F" . str_pad(dechex($level), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Draw character on client
     */
    public function drawChar($runInLot = false, $client_id = null) {
        if ($client_id != null) {
            $player = UltimaPHP::$socketClients[$client_id]['account']->player;
        } else {
            $player = $this;
        }

        $tmpEquips = "";

        foreach ($player->layers as $layer => $instance) {
            if ($layer > 29) {
                continue;
            }

            if ($instance !== null) {
                $tmpEquips .= str_pad($instance->serial, 8, "0", STR_PAD_LEFT);
                $tmpEquips .= str_pad(dechex(($instance->color > 0 ? ($instance->graphic | 0x8000) : $instance->graphic)), 4, "0", STR_PAD_LEFT);
                $tmpEquips .= str_pad(dechex($instance->layer), 2, "0", STR_PAD_LEFT);
                if ($instance->color > 0) {
                    $tmpEquips .= str_pad(dechex($instance->color), 4, "0", STR_PAD_LEFT);
                }
            }
        }

        $packet = "78";
        $packet .= str_pad(dechex(23 + ceil(strlen($tmpEquips) / 2)), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($player->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->position['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->position['y']), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::toChar8($player->position['z']);
        $packet .= str_pad(dechex($player->position['facing']), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(1), 2, "0", STR_PAD_LEFT);
        $packet .= $tmpEquips;
        $packet .= "00000000";

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Draw the player on client
     */
    public function drawPlayer($runInLot = false) {
        $packet = "20";
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
        $packet .= "00";
        $packet .= str_pad(dechex($this->color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->GetPacketFlags()), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['y']), 4, "0", STR_PAD_LEFT);
        $packet .= "0000";
        $packet .= str_pad(dechex($this->position['facing']), 2, "0", STR_PAD_LEFT);
        $packet .= Functions::toChar8($this->position['z']);
		
        Sockets::out($this->client, $packet, $runInLot);
    }
    
    /**
	* Return packet flags for > SA client
	* 
	* @return
	*/
    public function GetPacketFlags()
	{
		$flags = 0x00;

		if( $this->paralyzed || $this->frozen )
			$flags |= 0x01;

		if( $this->female )
			$flags |= 0x02;

		if( $this->flying )
			$flags |= 0x04;

		if( $this->blessed || $this->yellowHealthBar )
			$flags |= 0x08;

		if( $this->warmode )
			$flags |= 0x40;

		if( $this->hidden )
			$flags |= 0x80;

		return $flags;
	}

    /**
     * Packet sent to confirm player movement request
     *
     */
    public function movePlayer($runInLot = false, $direction = false, $sequence = false, $running = false, $fastwalk_prevention = 0) {
        /**
         * Remove dirname(path)ection flags
         */
        $tmpDirection = hexdec($direction);
        $tmpDirection &= ~0x80;

        if ((int) $direction >= 80) {
            $this->position['running'] = true;
        } else {
            $this->position['running'] = false;
        }

        if ((int) $this->position['facing'] != (int) $tmpDirection) {
            $this->position['facing'] = (int) $tmpDirection;
        } else {
            switch (hexdec($tmpDirection)) {
                case 0: /* North */
                    $this->position['y']--;
                    break;
                case 1: /* Northeast */
                    $this->position['x']++;
                    $this->position['y']--;
                    break;
                case 2: /* East */
                    $this->position['x']++;
                    break;
                case 3: /* Southeast */
                    $this->position['x']++;
                    $this->position['y']++;
                    break;
                case 4: /* South */
                    $this->position['y']++;
                    break;
                case 5: /* Southwest */
                    $this->position['x']--;
                    $this->position['y']++;
                    break;
                case 6: /* West */
                    $this->position['x']--;
                    break;
                case 7: /* Northwest */
                    $this->position['x']--;
                    $this->position['y']--;
                    break;
            }
            $this->lastMove = time();
        }

        $packet = "22" . str_pad($sequence, 2, "0", STR_PAD_LEFT) . "01";
        Sockets::out($this->client, $packet, false);

        /* Tell server to update player location */
        Map::updateChunk(null, $this->client);
    }

    /**
     * Send the update information of some player
     */
    public function updatePlayer($client_id) {
        $player    = UltimaPHP::$socketClients[$client_id]['account']->player;
        $direction = str_pad(($player->position['running'] === true ? 80 + $player->position['facing'] : $player->position['facing']), 2, "0", STR_PAD_LEFT);

        $packet = "77";
        $packet .= str_pad($player->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->position['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->position['y']), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::toChar8($player->position['z']);
        $packet .= str_pad($direction, 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->color), 4, "0", STR_PAD_LEFT);
        $packet .= "00";
        $packet .= "01";

        Sockets::out($this->client, $packet, false);
    }

    public function removeObjectFromView($serial = null) {
        if ($serial === null) {
            return false;
        }
        $packet = "1D";
        $packet .= str_pad($serial, 8, "0", STR_PAD_LEFT);

        /* Remove the object from player view range*/
        unset($this->mapRange[$serial]);

        Sockets::out($this->client, $packet, false);   
    }

    /**
     * Defines mount speed on the client
     *
     * 0 = Normal
     * 1 = Fast
     * 2 = Slow
     * >2 = Hybrid Moviment?
     *
     */
    public function mountSpeed($runInLot = false, $speed = 0) {
        $packet = "BF00060026" . str_pad(dechex($speed), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Update the client status bar information
     */
    public function updateStatusBar($runInLot = false) {
        $packet = "17";
        $packet .= "000F";
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= "0002000100000200";

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Update the status bar information on the client
     */
    public function statusBarInfo($runInLot = false, $client_id = false) {
        if ($client_id !== false && !is_array($client_id)) {
            $player = UltimaPHP::$socketClients[$client_id]['account']->player;

            $packet = "11";
            $packet .= str_pad(dechex(70), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad($player->serial, 8, "0", STR_PAD_LEFT);
            $packet .= str_pad(Functions::strToHex($player->name), 60, "0", STR_PAD_RIGHT);
            $packet .= str_pad(dechex(ceil($player->hits / ($player->maxhits / 100))), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(100), 4, "0", STR_PAD_LEFT);
            $packet .= (UltimaPHP::$socketClients[$this->client]['account']->plevel > 1 ? "01" : "00");
            $packet .= "00000000000000000000000000000000000000000000000000000000";

            Sockets::out($this->client, $packet);
        } else {
            $packet = "11";
            $packet .= "005B";
            $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
            $packet .= str_pad(Functions::strToHex($this->name), 60, "0", STR_PAD_RIGHT);
            $packet .= str_pad(dechex($this->hits), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->maxhits), 4, "0", STR_PAD_LEFT);
            $packet .= "00";
            $packet .= "05";
            $packet .= str_pad(dechex($this->sex), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->str), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->dex), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->int), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->stam), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->maxstam), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->mana), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->maxmana), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(0), 8, "0", STR_PAD_LEFT);
            $packet .= "0000";
            $packet .= str_pad("6", 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(400), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->race), 2, "0", STR_PAD_LEFT);

            if ($this->statscap > 0) {
                $packet .= str_pad(dechex($this->statscap), 4, "0", STR_PAD_LEFT);
            } else {
                $packet .= "0000";
            }
            $packet .= str_pad(dechex($this->pets), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->maxpets), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->resist_fire), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->resist_cold), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->resist_poison), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->resist_energy), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->luck), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->damage_min), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->damage_max), 4, "0", STR_PAD_LEFT);
            $packet .= "00000000";
            Sockets::out($this->client, $packet, $runInLot[0]);
        }
    }

    /**
     * Send extended stats to the client
     */
    public function extendedStats($runInLot = false, $flag = 0) {
        if (is_array($flag) && count($flag) == 0) {
            $flag = 0;
        }

        $packet = "BF000C001902" . str_pad($this->serial, 8, "0", STR_PAD_LEFT) . "00" . str_pad(dechex($flag), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Set war mode on client
     *
     * 0 = Peace
     * 1 = Fighting
     *
     */
    public function setWarMode($runInLot = false, $warmode = 0) {
        $packet = "72";
        $packet .= str_pad(dechex($warmode), 2, "0", STR_PAD_LEFT);
        $packet .= "003200";

        $this->warmode = $warmode;

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the login complete confirmation to the client
     */
    public function confirmLogin($runInLot = false) {
        Sockets::out($this->client, "55", $runInLot);
        Map::addPlayerToMap($this);
    }

    /**
     * Send time information to the client
     */
    public function setTime($runInLot = false) {
        $packet = "5B";
        $packet .= str_pad(dechex(date("H")), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(date("i")), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(date("s")), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    public function updateCurrentHealth($runInLot = false) {
        $packet = "A1" . str_pad($this->serial, 8, "0", STR_PAD_LEFT) . str_pad(dechex($this->maxhits), 2, "0", STR_PAD_LEFT) . str_pad(dechex($this->hits), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    public function updateCurrentMana($runInLot = false) {
        $packet = "A2" . str_pad($this->serial, 8, "0", STR_PAD_LEFT) . str_pad(dechex($this->maxmana), 2, "0", STR_PAD_LEFT) . str_pad(dechex($this->mana), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    public function updateCurrentStamina($runInLot = false) {
        $packet = "A3" . str_pad($this->serial, 8, "0", STR_PAD_LEFT) . str_pad(dechex($this->maxstam), 2, "0", STR_PAD_LEFT) . str_pad(dechex($this->stam), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, $runInLot);
    }

    public function sendCharName($serial) {
        $instance = Map::getBySerial($serial);

        if ($instance === false) {
            return false;
        }

        $tmpPacket = str_pad($serial, 8, "0", STR_PAD_LEFT);
        $tmpPacket .= str_pad(Functions::strToHex($instance->name), 60, "0", STR_PAD_RIGHT);


        $packet = "98";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 3), 4, "0", STR_PAD_LEFT);
        $packet .= $tmpPacket;

        Sockets::out($this->client, $packet);
    }
    
    public function actionOldVersion($serial) {
    	$frameCount = 0;
		$action = 0;
		$delay = 0;
		$repeat = 0;
		$repeatTimes = 0x00;
		$forward = 0x00;
		
        $packet = "6E";
        $packet .= str_pad($serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($action), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($frameCount), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($repeatTimes), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($forward), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($repeat), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($delay), 2, "0", STR_PAD_LEFT);

        //Sockets::out($this->client, $packet);
    }
    
	public function actionNewVersion($serial) {
		$type = 0;
		$action = 0;
		$delay = 0;
		
        $packet = "E2";
        $packet .= str_pad($serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($type), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($action), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($delay), 2, "0", STR_PAD_LEFT);

        //Sockets::out($this->client, $packet);
    }
}
