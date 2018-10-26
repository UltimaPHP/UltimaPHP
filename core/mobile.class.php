<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Mobile {
    /* Server variables */
    public $instanceType = UltimaPHP::INSTANCE_MOBILE;

    /* Temporary Variables */
    public $mapRange = [];

    /* Player variables */
    public $id;
    public $serial;

    public $body;
    public $color;
    public $name;
    public $objectName;
    public $owner;
    public $sex;
    // Riding flags
    public $layer;
    public $ridable;
    public $riding;
    // Flags -- init
    public $blessed;
    public $female;
    public $flying;
    public $frozen;
    public $hidden;
    public $ignoreMobiles;
    public $lastDestination;
    public $lastMove;
    public $paralyzed;
    public $walkSpeedFactor = 1;
    public $warmode;
    public $yellowHealthBar;
    // Flags -- end
    public $damage_max;
    public $damage_min;
    public $dex = 1;
    public $fame;
    public $hits;
    public $int = 1;
    public $karma;
    public $luck;
    public $mana;
    public $maxdex;
    public $maxhits;
    public $maxint;
    public $maxmana;
    public $maxpets;
    public $maxstam;
    public $maxstr;
    public $pets;
    public $position;
    public $race;
    public $render_range;
    public $resist_cold;
    public $resist_energy;
    public $resist_fire;
    public $resist_physical;
    public $resist_poison;
    public $skills = [];
    public $stam;
    public $statscap;
    public $str = 1;
    public $title;
    public $virtualarmor;

    public function __construct($serial = null, $ownerSerial = false) {
        $this->summon();
        $this->objectName = get_class($this);

        if ($this->ridable) {
            $this->layer = LayersDefs::MOUNT;
        }

        if ($serial === null) {
            $this->id = Map::newSerial('mobile');
            $this->serial = $this->id;

            if ($ownerSerial) {
                $this->owner = $ownerSerial;
            }

            $skillDefs = new ReflectionClass('SkillsDefs');
            $constants = $skillDefs->getConstants();

            foreach ($constants as $skill => $value) {
                if (strpos($skill, 'SKILL_FLAG') === false && $skill != 'SKILL_ALLSKILLS') {
                    $skillclass = "Skill" . ucfirst(strtolower(substr($skill, strlen('SKILL_'))));
                    $skilldef = "SkillsDefs::" . $skill;
                    $this->skills[constant($skilldef)] = new $skillclass((float) 0);
                }
            }

            $this->normalizeStats();

            /* Creates the item at the database */
            UltimaPHP::$db->collection("mobiles")->insertOne($this);
        } else {
            $this->id = $serial;
            $this->serial = $serial;
        }
    }

    public function click($client = null) {
        if ($client === null) {
            return false;
        }

        return $this->message($this->name, 0, 3, $client);
    }

    public function dclick($client = null) {
        if ($client === null) {
            return false;
        }

        if ($this->owner == $this->serial || UltimaPHP::$socketClients[$client]['account']->plevel > 1) {
            if ($this->ridable) {
                if ($this->riding) {
                    return $this->unmount($client);
                } else {
                    return $this->mount($client);
                }
            }
        } else {
            // DCLICK on mobile
        }

        return true;
    }

    /**
     * Draw mobile for client
     */
    public function draw($client) {
        $packet = "78";
        $packet .= str_pad(dechex(23), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['y']), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::toChar8($this->position['z']);
        $packet .= str_pad(dechex($this->position['facing']), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0x40), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0x06), 2, "0", STR_PAD_LEFT);
        $packet .= "00000000";

        Sockets::out($client, $packet);

        return true;
    }

    public function hear($message, $from) {
        $this->say("I've heard this: " . $message . " :)", 0, 3);

        if (strstr($message, "goto")) {
            $tmp = explode(",", str_replace("goto ", "", $message));
            $position = ['x' => $tmp[0], 'y' => $tmp[1], 'z' => (isset($tmp[2]) ? $tmp[2] : $this->position['z'])];
            $this->goToPosition($position);
        }
    }

    /**
     * Display a message above the mobile
     * If client not sent, send to all players around the mobile
     */
    public function message($text = null, $color = 0, $font = 3, $client = false) {
        if ($text === null || strlen($text) == 0) {
            return false;
        }

        $tmpPacket = Functions::strToHex($text);
        $packet = "1C";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 45), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($font), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(Functions::strToHex($this->name), 60, "0", STR_PAD_RIGHT);
        $packet .= $tmpPacket;
        $packet .= "00";

        if ($client) {
            Sockets::out($client, $packet, false);
        } else {
            Map::sendPacketRangePosition($packet, $this->position);
        }

        return true;
    }

    public function mount($client = nul) {
        if ($client === null) {
            return false;
        }

        $this->riding = true;
        $this->owner = UltimaPHP::$socketClients[$client]['account']->player->serial;
        $this->save();

        UltimaPHP::$socketClients[$client]['account']->player->layers[LayersDefs::MOUNT] = $this->serial;
        UltimaPHP::$socketClients[$client]['account']->player->mounted = true;

        $packet = "1D";
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);

        Map::removeSerialData($this->serial);
        Map::addHoldedMobile($this);

        Map::sendPacketRangePosition($packet, $this->position);
        UltimaPHP::$socketClients[$client]['account']->player->update();
        return true;
    }

    public function unmount($client = nul) {
        if ($client === null) {
            return false;
        }

        $this->riding = false;
        $this->save();

        $owner = Map::getBySerial($this->owner);
        $owner->layers[LayersDefs::MOUNT] = null;
        $owner->mounted = false;
        $owner->save();

        $packet = "1D";
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);

        Map::addMobileToMap($this, $owner->position['x'], $owner->position['y'], $owner->position['z'], $owner->position['map']);
        Map::sendPacketRangePosition($packet, $owner->position);
        $owner->update();
        return true;
    }

    public function move($direction = false) {
        if (is_array($direction)) {
            if (!isset($direction[0])) {
                return false;
            }

            $direction = $direction[0];
        }

        /**
         * Remove dirname(path)ection flags
         */
        $oldPos = $this->position;

        switch (hexdec($direction)) {
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
            default:
                return false;
                break;
        }
        $this->position['facing'] = $direction;

        /* Check if can go to position */
        $landTile = Map::getTerrainLand($this->position['x'], $this->position['y'], $this->position['z'], $this->position['map']);
        $canWalk = true;

        if ($landTile) {
            if ($landTile['flags'] & TiledataDefs::WALL || $landTile['flags'] & TiledataDefs::IMPASSABLE || $landTile['flags'] & TiledataDefs::DOOR) {
                $canWalk = false;
            }
        }

        if ($canWalk) {
            $staticsTiles = Map::getTerrainStatics($this->position['x'], $this->position['y'], $this->position['map']);
            if ($staticsTiles) {
                foreach ($staticsTiles as $tile) {
                    if (abs($tile['position']['z'] - $this->position['z']) >= 20) {
                        continue;
                    }

                    if ($tile['flags'] & TiledataDefs::WALL || $tile['flags'] & TiledataDefs::IMPASSABLE || $tile['flags'] & TiledataDefs::DOOR) {
                        $canWalk = false;
                    }
                }
            }
        }

        if ($canWalk) {
            $chunkInfo = Map::getChunk($this->position['x'], $this->position['y']);
            $chunkData = Map::$chunks[$this->position['map']][$chunkInfo['x']][$chunkInfo['y']];

            foreach ($chunkData as $serial => $data) {
                if ($data['type'] == "player") {
                    $player = UltimaPHP::$socketClients[$data['client']]['account']->player;

                    if ($player->position['x'] == $this->position['x'] && $player->position['y'] == $this->position['y']) {
                        $canWalk = false;
                    }
                } else {
                    if ($data['instance']->serial != $this->serial && $data['instance']->position['x'] == $this->position['x'] && $data['instance']->position['y'] == $this->position['y']) {
                        $canWalk = false;
                    }
                }
            }
        }

        if (!$canWalk) {
            $this->position = $oldPos;
            Sockets::removeAllSerialEvents($this->serial, ["option" => "mobile", "method" => "move"]);
            return false;
        }

        $this->lastMove = time();

        if ($statics = Map::getTerrainStatics($this->position['x'], $this->position['y'], $this->position['map'])) {
            $bz = $this->position['z'];

            foreach ($statics as $tile) {
                if (abs($tile['position']['z'] - $this->position['z']) >= 20) {
                    continue;
                }

                if ($bz > $this->position['z']) {
                    continue;
                }

                $bz = $tile['position']['z'] + $tile['height'];
            }

            $this->position['z'] = $bz;
        } else {
            if ($landTile = Map::getTerrainLand($this->position['x'], $this->position['y'], $this->position['map'])) {
                $this->position['z'] = $landTile['position']['z'];
            }
        }

        $this->update();
    }

    public function goToPosition($position) {
        $viewRange = [
            'from' => ['x' => ($this->position['x'] - UltimaPHP::$conf['muls']['render_range']), 'y' => ($this->position['y'] - UltimaPHP::$conf['muls']['render_range'])],
            'to' => ['x' => ($this->position['x'] + UltimaPHP::$conf['muls']['render_range']), 'y' => ($this->position['y'] + UltimaPHP::$conf['muls']['render_range'])],
        ];

        $map = [];

        $mY = 0;
        for ($y = $viewRange['from']['y']; $y <= $viewRange['to']['y']; $y++) {
            $map[$mY] = [];
            $mX = 0;

            for ($x = $viewRange['from']['x']; $x <= $viewRange['to']['x']; $x++) {
                $canWalk = true;

                $staticsTiles = Map::getTerrainStatics($x, $y, $this->position['map']);
                if ($staticsTiles) {
                    foreach ($staticsTiles as $tile) {
                        if (abs($tile['position']['z'] - $this->position['z']) >= 20) {
                            continue;
                        }

                        if ($tile['flags'] & TiledataDefs::STAIRBACK || $tile['flags'] & TiledataDefs::STAIRRIGHT) {
                            continue;
                        }

                        if ($tile['flags'] & TiledataDefs::WALL || $tile['flags'] & TiledataDefs::IMPASSABLE || $tile['flags'] & TiledataDefs::DOOR) {
                            $canWalk = false;
                        }
                    }
                }

                if ($this->position['x'] == $x && $this->position['y'] == $y) {
                    $map[$mY][$mX] = 1; // Source
                } else if ($position['x'] == $x && $position['y'] == $y) {
                    $map[$mY][$mX] = 2; // Destination
                } else {
                    $map[$mY][$mX] = ($canWalk ? 0 : 4);
                }
                $mX++;
            }
            $mY++;
        }

        $flowPath = new FlowPath($map, true);
        $steps = $flowPath->getPath();

        // $flowPath->dumpPath();

        if (!$steps || count($steps) == 0) {
            return false;
        }

        if (count($steps) >= 3) {
            $this->position['running'] = true;
        }

        foreach ($steps as $stepId => $dir) {
            Sockets::addSerialEvent($this->serial, [
                "option" => "mobile",
                "method" => "move",
                "args" => $dir,
            ], ($stepId * (0.25 / $this->walkSpeedFactor)));
        }
    }

    /**
     * Updates the database record about the object instance
     */
    public function save() {
        UltimaPHP::$db->collection('mobiles')->updateOne(['id' => $this->id], ['$set' => $this]);
        return true;
    }

    /**
     * Removes the database record about the object instance
     */
    public function remove() {
        if ($this->riding) {
            $owner = Map::getBySerial($this->owner);
            $owner->mounted = false;
            $owner->layers[LayersDefs::MOUNT] = null;
            //$owner->pets--;
            $owner->save();
        }
        UltimaPHP::$db->collection('mobiles')->deleteOne(['id' => $this->id]);
        return true;
    }

    /**
     * Display a "say" message above the mobile
     * It client not sent, send to all players around the mobile
     */
    public function say($text = null, $color = 0, $font = 3, $client = false, $type = 0) {
        // If it's an emote
        if (dechex($type) == 0x02) {
            $text = "* $text *";
            $name = "You see";

            if (hexdec($color) == 0) {
                $color = UltimaPHP::$conf['colors']['emote'];
            }
        } else {
            $name = $this->name;
        }

        $tmpPacket = Functions::strToHex($text, true);

        $packet = "AE";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 50), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($type), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($font), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::strToHex("ENU ");
        $packet .= str_pad(Functions::strToHex($name), 60, "0", STR_PAD_RIGHT);
        $packet .= $tmpPacket;
        $packet .= "0000";

        if ($client) {
            Sockets::out($client, $packet, false);
        } else {
            Map::sendPacketRangePosition($packet, $this->position);
        }

        return true;
    }

    public function setName($newName = false, $client = false) {
        if (!$newName) {
            return false;
        }

        $this->name = $newName;

        if (!$client) {
            return true;
        }

        return $this->draw();
    }

    public function showTooltip($client = false) {
    }

    public function statusBarInfo($client) {
        $packet = "11";
        $packet .= str_pad(dechex(70), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(Functions::strToHex($this->name), 60, "0", STR_PAD_RIGHT);
        $packet .= str_pad(dechex(ceil($this->hits / ($this->maxhits / 100))), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(100), 4, "0", STR_PAD_LEFT);
        $packet .= (UltimaPHP::$socketClients[$client]['account']->plevel > 1 ? "01" : "00");
        $packet .= "00000000000000000000000000000000000000000000000000000000";

        Sockets::out($client, $packet);

        return true;
    }

    /**
     * Send the mobile update information
     */
    public function update() {
        $direction = str_pad(($this->position['running'] === true ? 80 + $this->position['facing'] : $this->position['facing']), 2, "0", STR_PAD_LEFT);

        $packet = "77";
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->position['y']), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::toChar8($this->position['z']);
        $packet .= str_pad($direction, 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->color), 4, "0", STR_PAD_LEFT);
        $packet .= "00";
        $packet .= "01";

        Map::sendPacketRangePosition($packet, $this->position);
    }

    private function normalizeStats() {
        if ($this->maxstr == 0) {
            $this->maxstr = $this->str;
        } else {
            $this->str = $this->maxstr;
        }

        if ($this->hits == 0) {
            if ($this->maxhits > 0) {
                $this->hits = $this->maxhits;
            } else {
                $this->hits = $this->str;
                $this->maxhits = $this->str;
            }
        }

        if ($this->maxint == 0) {
            $this->maxint = $this->int;
        } else {
            $this->int = $this->maxint;
        }

        if ($this->mana == 0) {
            if ($this->maxmana > 0) {
                $this->mana = $this->maxmana;
            } else {
                $this->mana = $this->int;
                $this->maxmana = $this->int;
            }
        }

        if ($this->maxdex == 0) {
            $this->maxdex = $this->dex;
        } else {
            $this->dex = $this->maxdex;
        }

        if ($this->stam == 0) {
            if ($this->maxstam > 0) {
                $this->stam = $this->maxstam;
            } else {
                $this->stam = $this->dex;
                $this->maxstam = $this->dex;
            }
        }
    }
}
