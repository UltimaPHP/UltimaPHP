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
    public $mongoId;
    public $serial;
    public $name;
    public $body;
    public $color;
    public $sex;
    public $layers;
    public $target;
    public $callbacks;
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

    public function __construct($client = null, $character = null) {
        if (null === $client || null === $character) {
            return false;
        }

        $this->client       = $client;
        $this->serial       = str_pad($character['serial'], 8, "0", STR_PAD_LEFT);
        $this->id           = $character['player_serial'];
        $this->render_range = UltimaPHP::$conf['muls']['render_range'];
        $this->callbacks    = new PlayerCallbacks($client);

        $result = UltimaPHP::$db->collection("players")->find(['player_serial' => $this->id])->toArray();

        if (isset($result[0])) {
            $this->mongoId         = $result[0]['_id'];
            $this->name            = $result[0]['name'];
            $this->body            = $result[0]['body'];
            $this->color           = $result[0]['color'];
            $this->sex             = $result[0]['sex'];
            $this->race            = $result[0]['race'];
            $this->position        = $result[0]['position'];
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

            foreach ($result[0]['skills'] as $skill => $value) {
                $skillclass = "Skill" . ucfirst($skill);
                $skilldef   = "SkillsDefs::SKILL_" . strtoupper($skill);

                if (class_exists($skillclass)) {
                    $this->skills[constant($skilldef)] = new $skillclass((float) $value);
                } else {
                    UltimaPHP::log("Trying to set $skilldef to player  " . $this->name . " (" . $this->serial . ")", "ERROR");
                }
            }

            /* Define player layers */
            for ($i = 1; $i <= 31; $i++) {
                $this->layers[$i] = null;
            }

            $objects = UltimaPHP::$db->collection('objects')->find(['holder' => $this->serial], ['projection' => ['serial' => true]])->toArray();

            foreach ($objects as $item) {
                $instance = Map::getBySerial($item['serial']);

                if ($this->layers[$instance->layer] === null) {
                    $this->layers[$instance->layer] = $instance->serial;
                }
            }

            return true;
        }
        UltimaPHP::$socketClients[$this->client]['account']->disconnect();
        return false;
    }

    public function update() {
        /* Clear old objects from map view */
        foreach ($this->mapRange as $serial => $info) {
            $this->removeObjectFromView($serial);
        }

        $this->mapRange = [];
        
        $this->updateCursorColor(false, $this->position['map']);
        $this->drawChar();
        $this->drawPlayer();

        Map::updateChunk(null, $this->client);
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

        $instance = Map::getBySerial($serial);

        if (!$instance) {
            return false;
        }

        return $instance->click($this->client);
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
            if ($instance->holder === null) {
                $face = Functions::getRelativeFace([$this->position['x'], $this->position['y']], [$instance->position['x'], $instance->position['y']]);

                if ($this->position['facing'] != $face) {
                    $this->position['facing'] = $face;
                    $this->update();
                }
            }

            return $instance->dclick($this->client);
        }

        return false;
    }

    public function attachTarget($client, $callback = null) {
        if ($this->target !== null) {
            new SysmessageCommand($client, ["Target canceled."]);
        }

        $packet = "6C01";
        $packet .= str_pad($client, 8, "0", STR_PAD_LEFT);
        $packet .= "00000000000000000000000000";

        if ($callback !== null) {
            $this->target = $callback;
        }

        Sockets::out($client, $packet, false);
    }

    public function targetAction($client, $target) {
        if ($target['x'] == 0xFFFF || $target['y'] == 0xFFFF) {
            $this->target = null;
            new SysmessageCommand($client, ["Target canceled."]);
            return true;
        }

        if ($this->target === null) {
            new SysmessageCommand($client, "Target failed, there is an error at the script.");
            return false;
        }

        $callback = $this->target['method'];
        $this->callbacks->$callback($target, $this->target['args']);
        $this->target = null;
        return true;
    }

    public function equipRequest($serial = null, $layer = null, $container = null) {
        if ($serial === null || $layer === null) {
            return false;
        }

        $instance = Map::getBySerial($serial);
        $containerInstance = Map::getBySerial($container);

        if ($instance->holder !== null) {
            $holder = Map::getBySerial($instance->holder);

            if ($holder->instanceType == UltimaPHP::INSTANCE_PLAYER) {
                $holderBackpack = Map::getBySerial($holder->layers[LayersDefs::BACKPACK]);

                if (!$holderBackpack) {

                    if ($instance->objectName == "Backpack") {
                        $instance->holder = $this->serial;
                        
                        if (Map::isValidSerial($instance->serial)) {
                            Map::updateObjectHolder($instance);
                        } else {
                            Map::addHoldedObject($instance);
                        }

                        $this->layers[LayersDefs::BACKPACK] = $instance->serial;
                        $this->update();
                        return true;
                    }

                    $holderBackpack = new Backpack(null, null, $this->serial);
                    Map::addHoldedObject($holderBackpack);

                    $this->layers[LayersDefs::BACKPACK] = $holderBackpack->serial;
                    $this->update();

                }

                if ($holder->serial != $this->serial && UltimaPHP::$socketClients[$this->client]['account']->plevel < UltimaPHP::$socketClients[$holder->client]['account']->plevel) {
                    new SysmessageCommand($this->client, ["Sorry, you have no privileges to change this player equipment."]);
                    return false;
                }

                if ($holder->layers[$instance->layer] !== null) {
                    new SysmessageCommand($this->client, ["Sorry, this item is allready equiped."]);
                    return false;
                }
            } else if ($holder->instanceType == UltimaPHP::INSTANCE_OBJECT) {
                if (UltimaPHP::$socketClients[$this->client]['account']->plevel == 1 && $holder->owner !== null && $holder->owner != $this->serial) {
                    new SysmessageCommand($this->client, ["Sorry, you have no privileges to use this container."]);
                    return false;
                }

                $holder->removeItem($this->client, $instance->serial);
            } else {
                return false;
            }
        } else {
            Map::removeSerialData($instance->serial);
        }

        if ($this->layers[$instance->layer] !== null) {
            $playerBackpack = Map::getBySerial($this->layers[LayersDefs::BACKPACK]);

            if (!$playerBackpack) {
                if ($instance->objectName == "Backpack") {
                    $instance->holder = $this->serial;
                    
                    if (Map::isValidSerial($instance->serial)) {
                        Map::updateObjectHolder($instance);
                    } else {
                        Map::addHoldedObject($instance);
                    }

                    $this->layers[LayersDefs::BACKPACK] = $instance->serial;
                    $this->update();
                    // return true;
                } else {
                    $playerBackpack = new Backpack(null, null, $this->serial);
                    Map::addHoldedObject($playerBackpack);

                    $this->layers[LayersDefs::BACKPACK] = $playerBackpack->serial;
                    $this->update();
                }
            }

            $layerInstance = Map::getBySerial($this->layers[$instance->layer]);
            UltimaPHP::$socketClients[$this->client]['account']->player->layers[$instance->layer] = null;

            $playerBackpack->addItem($this->client, $layerInstance, ['x' => rand(1,127), 'y' => rand(1,127), 'z' => 0, 'map' => null]);
        }

        $this->layers[$instance->layer] = $instance->serial;

        $instance->holder = $this->serial;
        $instance->save();
        
        if (Map::isValidSerial($instance->serial)) {
            Map::updateObjectHolder($instance);
        } else {
            Map::addHoldedObject($instance);
        }

        $this->forceUpdate = true;
        $this->drawChar();
        Map::updateChunk(null, $this->client);

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

        Map::removeSerialData($serial, ($instance->holder === null ? false : true));

        /* Remove the intem from the container */
        if ($instance->holder !== null) {
            $container = Map::getBySerial($instance->holder);

            if ($container->instanceType == UltimaPHP::INSTANCE_OBJECT) {
                $container->removeItem($this->client, $instance->serial, true);
            } else {
                for ($i = 1; $i <= 31; $i++) {
                    if ($this->layers[$i] == $instance->serial) {
                        $this->layers[$i] = null;
                    }
                }
            }
        }

        $this->layers[LayersDefs::DRAGGING] = $instance->serial;
        $instance->holder = $this->serial;
        $instance->save();
        
        Map::addHoldedObject($instance);

        return true;
    }

    public function dropItem($serial = null, $position = null, $grid = null, $container = null) {
        if ($serial === null || $position === null || $grid === null || $container === null) {
            return false;
        }

        if ($this->layers[LayersDefs::DRAGGING] === null || $this->layers[LayersDefs::DRAGGING] != $serial) {
            return false;
        }

        $instance = Map::getBySerial($serial);

        Map::removeSerialData($serial, true);

        $this->layers[LayersDefs::DRAGGING] = null;

        if ($container == "FFFFFFFF") {
            Map::addObjectToMap($instance, $position['x'], $position['y'], $position['z'], $this->position['map']);
            return true;
        }

        $containerInstance = Map::getBySerial($container);

        if (!$containerInstance) {
            return false;
        }

        if ($containerInstance->instanceType == UltimaPHP::INSTANCE_OBJECT) {
            if ($position['x'] == 65535) {
                $position['x'] = rand(1,127);
            }
            if ($position['y'] == 65535) {
                $position['y'] = rand(1,127);
            }
            $containerInstance->addItem($this->client, $instance, $position);
            return $this->dropAccept();
        }

        if ($containerInstance->serial == $this->serial) {
            $playerBackpack = Map::getBySerial($this->layers[LayersDefs::BACKPACK]);

            if (!$playerBackpack) {

                if ($instance->objectName == "Backpack") {
                    $instance->holder = $this->serial;
                    
                    if (Map::isValidSerial($instance->serial)) {
                        Map::updateObjectHolder($instance);
                    } else {
                        Map::addHoldedObject($instance);
                    }

                    $this->layers[LayersDefs::BACKPACK] = $instance->serial;
                    $this->update();

                    return $this->dropAccept();
                }

                $playerBackpack = new Backpack(null, null, $this->serial);
                Map::addHoldedObject($playerBackpack);

                $this->layers[LayersDefs::BACKPACK] = $playerBackpack->serial;
                $this->update();
            }

            $instance->holder = $playerBackpack->serial;

            $playerBackpack->addItem($this->client, $instance, ['x' => rand(1,127), 'y' => rand(1,127), 'z' => 0, 'map' => null]);

            return $this->dropAccept();
        }

        if ($containerInstance->instanceType == UltimaPHP::INSTANCE_MOBILE) {
            $mobileBackpack = Map::getBySerial($container->layers[LayersDefs::BACKPACK]);

            $instance->holder = $mobileBackpack->serial;

            $mobileBackpack->addItem($this->client, $instance, ['x' => rand(1,127), 'y' => rand(1,127), 'z' => 0, 'map' => null]);

            return $this->dropAccept();
        }

        if ($containerInstance->instanceType == UltimaPHP::INSTANCE_PLAYER) {
            /* Trade window */
            return $this->dropAccept();
        }

        return false;
    }

    /**
     * Send the client drop accept - A ser testado
     */
    public function dropAccept($runInLot = false) {
        $packet = "29";
        Sockets::out($this->client, $packet, $runInLot);
        return true;
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

        if ($instance->warmode) {
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
            if ($color == 0) {
                $color = UltimaPHP::$conf['colors']['sysmessage'];
            }

            $tmpPacket = Functions::strToHex($text, true);
            $packet    = "AE";
            $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 50), 4, "0", STR_PAD_LEFT);
            $packet .= "FFFFFFFF";
            $packet .= "FFFF";
            $packet .= "00";
            $packet .= str_pad($color, 4, "0", STR_PAD_LEFT);
            $packet .= "0000";
            $packet .= "00000000";
            $packet .= str_pad(Functions::strToHex("System"), 60, "0", STR_PAD_RIGHT);
            $packet .= $tmpPacket;
            $packet .= "0000";
        } else {
            $name = $this->name;
            // If it's an emote
            if (dechex($type) == 0x02) {
                $text = "* $text *";
                $name = "You see";

                if (hexdec($color) == 0) {
                    $color = UltimaPHP::$conf['colors']['emote'];
                }
            }

            $tmpPacket = Functions::strToHex($text, true);
            $packet    = "AE";
            $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 50), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($type), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad($color, 4, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($font), 4, "0", STR_PAD_LEFT);
            $packet .= Functions::strToHex($language);
            $packet .= str_pad(Functions::strToHex($name), 60, "0", STR_PAD_RIGHT);
            $packet .= $tmpPacket;
            $packet .= "0000";

            Map::sendPacketRange($packet, $this->client);
            Map::sendHearMessage($text, $this->client);
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
            'map'    => $this->position['map'],
            'facing' => $this->position['facing'],
        );
        $mapInfo  = explode(",", UltimaPHP::$conf['muls']["map" . $this->position['map']]);
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
        $packet .= str_pad(($this->position['map'] > 0 ? dechex($map_size['x']) : 0x1800), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(($this->position['map'] > 0 ? dechex($map_size['y']) : 0x1000), 4, "0", STR_PAD_LEFT);
        $packet .= "000000000000";
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the skills information to the client
     */
    public function sendFullSkillList($runInLot = false) {
        $tmpPacket = "02";

        foreach ($this->skills as $skill_id => $skillInfo) {
            $tmpPacket .= str_pad(dechex($skill_id + 1), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($skillInfo->value * 10), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($skillInfo->value * 10), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= "00";
            $tmpPacket .= str_pad(dechex(((float) UltimaPHP::$conf['accounts']['skillcap']) * 10), 4, "0", STR_PAD_LEFT);
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
        $packet .= str_pad(dechex($maps - 1), 8, "0", STR_PAD_LEFT);

        for ($i = 0; $i < ($maps - 1); $i++) {
            if (UltimaPHP::$conf['muls']['useDif'] && UltimaPHP::$files[Reader::FILE_MAP_DIF][$i] !== null) {
                $packet .= str_pad(dechex(UltimaPHP::$files[Reader::FILE_MAP_DIF][$i]->fileLength / 4), 8, "0", STR_PAD_LEFT);
                $packet .= str_pad(dechex(UltimaPHP::$files[Reader::FILE_MAP_DIF][$i]->fileLength / 4), 8, "0", STR_PAD_LEFT);
            } else {
                $packet .= "0000000000000000";
            }
        }

        $packet = "BF" . str_pad(dechex((strlen($packet) / 2) + 3), 4, "0", STR_PAD_LEFT) . $packet;
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

        foreach ($player->layers as $layer => $serial) {
            if ($layer > 29) {
                continue;
            }

            if ($serial !== null) {
                $instance = Map::getBySerial($serial);

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
    public function GetPacketFlags() {
        $flags = 0x00;

        if ($this->paralyzed || $this->frozen) {
            $flags |= 0x01;
        }

        if ($this->female) {
            $flags |= 0x02;
        }

        if ($this->flying) {
            $flags |= 0x04;
        }

        if ($this->blessed || $this->yellowHealthBar) {
            $flags |= 0x08;
        }

        if ($this->warmode) {
            $flags |= 0x40;
        }

        if ($this->hidden) {
            $flags |= 0x80;
        }

        return $flags;
    }

    /**
     * Packet sent to confirm player movement request
     *
     */
    public function movePlayer($runInLot = false, $direction = false, $sequence = false) {
        /**
         * Remove dirname(path)ection flags
         */
        $tmpDirection = hexdec($direction);
        $tmpDirection &= ~0x80;

        $tmpPosition = $this->position;

        if ((int) $direction >= 80) {
            $tmpPosition['running'] = true;
        } else {
            $tmpPosition['running'] = false;
        }

        if ((int) $tmpPosition['facing'] != (int) $tmpDirection) {
            $tmpPosition['facing'] = (int) $tmpDirection;
        } else {
            switch (hexdec($tmpDirection)) {
                case 0: /* North */
                    $tmpPosition['y']--;
                    break;
                case 1: /* Northeast */
                    $tmpPosition['x']++;
                    $tmpPosition['y']--;
                    break;
                case 2: /* East */
                    $tmpPosition['x']++;
                    break;
                case 3: /* Southeast */
                    $tmpPosition['x']++;
                    $tmpPosition['y']++;
                    break;
                case 4: /* South */
                    $tmpPosition['y']++;
                    break;
                case 5: /* Southwest */
                    $tmpPosition['x']--;
                    $tmpPosition['y']++;
                    break;
                case 6: /* West */
                    $tmpPosition['x']--;
                    break;
                case 7: /* Northwest */
                    $tmpPosition['x']--;
                    $tmpPosition['y']--;
                    break;
            }
        }

        /* Updates player Z */
        $topItem = Map::getTopItemFrom($tmpPosition['x'], $tmpPosition['y'], $tmpPosition['z'], $tmpPosition['map']);

        /* Logic to block player walking into impossible locations */
        if ($topItem) {
            /*
            // This code is commented ultill we find a solution to fix the Z detection from textured land tiles
            if (abs($topItem['position']['z'] - $this->position['z']) > 10) {
                new SysmessageCommand($this->client, ["You can't walk in there."]);

                $packet = new packet_0x21($this->client);
                $packet->setPosition($tmpPosition['x'], $tmpPosition['y'], $tmpPosition['z'], $tmpPosition['facing'], $sequence);
                $packet->send();

                $this->update();
                return true;
            }
            */

            $tmpPosition['z'] = $topItem['position']['z'];
        }

        $this->position = $tmpPosition;
        $this->lastMove = time();

        $packet = "22" . str_pad($sequence, 2, "0", STR_PAD_LEFT) . "01";
        Sockets::out($this->client, $packet, false);

        /* Tell server to update player location */
        Map::updateChunk(null, $this->client);

        /* Update player position on database */
        UltimaPHP::$db->collection("players")->updateOne(['_id' => $this->mongoId], ['$set' => ['position' => $this->position]]);
    }

    /**
     * Packet sent to confirm player movement request
     *
     */
    public function newMovePlayer($runInLot = false, $newPosition = [], $direction = false, $running = false, $count = false) {
        $tmpPosition = $this->position;

        $tmpPosition['running'] = $running;

        if ((int) $tmpPosition['facing'] != (int) $direction) {
            $tmpPosition['facing'] = (int) $direction;
        } else {
            $tmpPosition['x'] = $newPosition['x'];
            $tmpPosition['y'] = $newPosition['y'];
            $tmpPosition['z'] = $newPosition['z'];
        }

        $this->position = $tmpPosition;
        $this->lastMove = time();

        $packet = "22" . str_pad($count, 2, "0", STR_PAD_LEFT) . "01";

        Sockets::out($this->client, $packet, false);

        /* Tell server to update player location */
        Map::updateChunk(null, $this->client);

        /* Update player position on database */
        UltimaPHP::$db->collection("players")->updateOne(['_id' => $this->mongoId], ['$set' => ['position' => $this->position]]);
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

        /* Remove the object from player view range */
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
        $frameCount  = 0;
        $action      = 0;
        $delay       = 0;
        $repeat      = 0;
        $repeatTimes = 0x00;
        $forward     = 0x00;

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
        $type   = 0;
        $action = 0;
        $delay  = 0;

        $packet = "E2";
        $packet .= str_pad($serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($type), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($action), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($delay), 2, "0", STR_PAD_LEFT);

        //Sockets::out($this->client, $packet);
    }
}
