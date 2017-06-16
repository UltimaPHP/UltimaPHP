<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Mobile {
    /* Server variables */
    public $instanceType = UltimaPHP::INSTANCE_MOBILE;

    /* Player variables */
    public $id;
    public $serial;
    public $name;
    public $body;
    public $color;
    public $sex;
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
    public $virtualarmor;

    /* Temporary Variables */
    public $mapRange = [];

    public function __construct($serial = null) {
        if ($serial === null) {
            $this->id     = Map::newSerial('mobile');
            $this->serial = $this->id;
        }
        $this->summon();
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

    /**
     * Display a message above the mobile
     * It client not sent, send to all players around the mobile
     */
    public function message($text = null, $color = 0, $font = 3, $client = false) {
        if ($text === null || strlen($text) == 0) {
            return false;
        }

        $tmpPacket = Functions::strToHex($text);
        $packet    = "1C";
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

    /**
     * Display a "say" message above the mobile
     * It client not sent, send to all players around the mobile
     */
    public function say($text = null, $color = 0, $font = 3, $client = false) {
        if ($text === null || mb_strlen($text) == 0) {
            return false;
        }

        $tmpPacket = Functions::mbStrToHex($text, true);

        $packet = "AE";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 50), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($font), 4, "0", STR_PAD_LEFT);
        $packet .= Functions::strToHex("ENU ");
        $packet .= str_pad(Functions::strToHex($this->name), 60, "0", STR_PAD_RIGHT);
        $packet .= $tmpPacket;
        $packet .= "0000";

        if ($client) {
            Sockets::out($client, $packet, false);
        } else {
            Map::sendPacketRangePosition($packet, $this->position);
        }

        return true;
    }

    public function click($client = null) {
        if ($client === null) {
            return false;
        }

        return $this->message($this->name, 0, 3, $client);
    }

    /**
     * Send the mobile update information
     */
    public function updateMobile() {
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

    public function move($direction = false) {
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
        }
        $this->position['facing'] = $direction;

        /* Check if can go to position */
        $landTile = Map::getTerrainLand($this->position['x'], $this->position['y'], $this->position['map']);
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
                    if (abs($tile['position']['z'] - $this->position['z']) > 10) {
                        continue;
                    }
                    if ($tile['flags'] & TiledataDefs::WALL || $tile['flags'] & TiledataDefs::IMPASSABLE || $tile['flags'] & TiledataDefs::DOOR) {
                        $canWalk = false;
                    }
                }
            }
        }

        if (!$canWalk) {
            $this->position = $oldPos;
        }

        $this->lastMove = time();

        /* Updates player Z */
        if ($land = Map::getTerrainLand($this->position['x'], $this->position['y'], $this->position['map'])) {
            $this->position['z'] = $land['position']['z'];
        }

        $this->updateMobile();
    }

    public function goTo($position) {
        $viewRange = [
            'from' => ['x' => ($this->position['x'] - UltimaPHP::$conf['muls']['render_range']), 'y' => ($this->position['y'] - UltimaPHP::$conf['muls']['render_range'])],
            'to'   => ['x' => ($this->position['x'] + UltimaPHP::$conf['muls']['render_range']), 'y' => ($this->position['y'] + UltimaPHP::$conf['muls']['render_range'])],
        ];

        $map = [];

        $mY = 0;
        for ($y = $viewRange['from']['y']; $y <= $viewRange['to']['y']; $y++) {
            $map[$mY] = [];
            $mX = 0;

            for ($x = $viewRange['from']['x']; $x <= $viewRange['to']['x']; $x++) {
                $landTile = Map::getTerrainLand($x, $y, $this->position['map']);
                $canWalk = true;

                if ($landTile) {
                    if ($landTile['flags'] & TiledataDefs::WALL || $landTile['flags'] & TiledataDefs::IMPASSABLE || $landTile['flags'] & TiledataDefs::DOOR) {
                        $canWalk = false;
                    }
                }

                if ($canWalk) {
                    $staticsTiles = Map::getTerrainStatics($x, $y, $this->position['map']);
                    if ($staticsTiles) {
                        foreach ($staticsTiles as $tile) {
                            if (abs($tile['position']['z'] - $this->position['z']) > 10) {
                                continue;
                            }
                            if ($tile['flags'] & TiledataDefs::WALL || $tile['flags'] & TiledataDefs::IMPASSABLE || $tile['flags'] & TiledataDefs::DOOR) {
                                $canWalk = false;
                            }
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

        if (count($steps) > 3) {
            $this->position['running'] = true;
        }

        foreach($steps as $stepId => $dir) {
            Sockets::addSerialEvent($this->serial, array(
                "option" => "mobile",
                "method" => "move",
                "args"   => $dir,
            ), ($stepId * 0.2));
        }
    }

    public function hear($message, $from) {
        if (strstr($message, "goto")) {
            $tmp = explode(",", str_replace("goto ", "", $message));
            $position = ['x' => $tmp[0], 'y' => $tmp[1]];
            $this->goTo($position);
        }
    }
}