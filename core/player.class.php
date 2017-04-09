<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Player {
    /* Server variables */

    public $client;

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

    /* Temporary Variables */
    public $mapRange = array(
        'objects' => array(),
        'players' => array(),
        'npcs'    => array(),
    );

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
            $this->position = array(
                'x'       => $position[0],
                'y'       => $position[1],
                'z'       => $position[2],
                'map'     => $position[3],
                'facing'  => 6,
                'running' => 0,
            );
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
                    }
                }
            }
        } else {
            UltimaPHP::$socketClients[$this->client]['account']->disconnect();
        }
    }

    public function click($object = null) {
        if ($object === null) {
            return false;
        }

        if (hexdec($object) & UltimaPHP::BITMASK_ITEM) {
            echo "clicked on object";
        }
    }

    public function dclick($serial = null) {
        if ($serial === null) {
            return false;
        }

        // Check if the character dclick itself

        if (($this->serial | "80000000") || Functions::isChar($serial)) {
            $this->openPaperdoll($serial);
        } else {
            echo "Clicked something else\n";
        }
    }

    public function pickUp($item_serial, $amount) {
        echo "Player tryies to pickup {$amount}x item serial: $item_serial";

        $packet = "13";
        $packet .= $item_serial;
        $packet .= "15"; // Backpack
        $packet .= $this->serial;
        Sockets::out($this->client, $packet, false);
    }

    public function openPaperdoll($serial) {
        if ($serial | 0x80000000) {
            $serial = "0" . substr($serial, 1);
        }

        $packet = "88";
        $packet .= $serial;
        echo strlen($this->name)." | ".$this->title;
        $packet .= str_pad($this->name . " " . $this->title, 120, "0", STR_PAD_RIGHT);

        $flags = 0x00;

        // Can alter paperdoll
        if ($serial == $this->serial) {
            $flags = $flags | 0x02;
        }

        $packet .= str_pad(hexdec($flags), 2, "0", STR_PAD_LEFT);

        Sockets::out($this->client, $packet, false);
    }

    public function speech($type, $color, $font, $language, $text) {
        switch (substr($text, 0, 1)) {
        case '.':
            if (strstr($text, ",")) {
                $tmp     = explode(",", $text);
                $command = explode(" ", substr($tmp[0], 1));
                $args    = $tmp;
                unset($args[0]);
                array_merge([], $args);
            } else {
                $command = explode(" ", substr($text, 1));
                $args    = [];
            }

            $this->runCommand($command, $args);
            return true;
            break;
        }

        if (dechex($type) == 0x06) {
            $tmpPacket = Functions::strToHex($text);
            $packet    = "1C";
            $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 45), 4, "0", STR_PAD_LEFT);
            $packet .= str_pad((dechex($type) == 0x06 ? "FFFFFFFF" : $this->serial), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad((dechex($type) == 0x06 ? "FFFF" : $this->body), 2, "0", STR_PAD_LEFT);
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
            $packet .= $this->serial;
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

    public function runCommand($command = [], $args = []) {
        if (UltimaPHP::$socketClients[$this->client]['account']->plevel > 1 && !isset($command[0])) {
            $this->sysmessage("Sorry, but no command was received from client.");
            return false;
        }

        if (!isset(UltimaPHP::$commands[$command[0]])) {
            $this->sysmessage("Sorry, the command you are trying to run was not been found.");
            return false;
        }

        if (UltimaPHP::$commands[$command[0]]['minPlevel'] > UltimaPHP::$socketClients[$this->client]['account']->plevel) {
            $this->sysmessage("Sorry, but you can't run this command, your account have no rights to do that.");
            return false;
        }

        $cmd  = $command[0];
        $args = array_slice($command, 1);

        if ($cmd == "i") {

            $itemDef = str_replace(" ", "_", $args[0]);
            if (!class_exists($itemDef)) {
                $this->sysmessage("Sorry, but the item you are trying to create (" . $args[0] . ") has not been found.");
                return false;
            }

            $item = new $itemDef();
            Map::addObjectToMap($item, $this->position['x'], $this->position['y'], $this->position['z'], 0);
        }

        if ($cmd == "sysmessage") {
            $this->sysmessage($args[0]);
        }
        
        if ($cmd == "tele"){						
			$this->teleport($args[0],$args[1],$args[2],$args[3]);
		}
		
		if ($cmd == "where"){				
			$this->sysmessage("Your position is ".$this->position['x'].", ".$this->position['y'].", ".$this->position['z'].", ".$this->position['map']);
		}
		
		if ($cmd == "invis"){	
			if ($this->hidden == false || $this->hidden == null)
			{
				$this->hidden = TRUE;	
			}			
			else
			{
				$this->hidden = FALSE;
			}
			$this->drawPlayer($this->client);
		}
    }
    
    public function teleport($x, $y, $z, $map) {
    	$oldPosition = $this->position;    	
        if ($x === null || $y === null || $z === null || $map === null) {
            $this->sysmessage("Sorry, information is missing. The default is \"x y z map\"");
            return false;
        }else{
			$this->position['x'] = $x;
			$this->position['y'] = $y;
			$this->position['z'] = $z;
			$this->position['map'] = $map;
			$newPosition = $this->position;
			Map::updatePlayerLocation($this->client, $oldPosition, $newPosition);
			$this->drawPlayer($this->client);			
		}
        
        return true;
    }


    public function sysmessage($message, $color = null) {
        if ($color === null) {
            $color = UltimaPHP::$conf['colors']['text'];
        }

        $this->speech("06", $color, 3, "PTB ", $message);
        return true;
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
            'facing' => $this->position['facing'],
        );
        $map_size = array(
            'x' => 6144,
            'y' => 4096,
        );

        $packet = "1B";
        $packet .= $this->serial;
        $packet .= "00000000";
        $packet .= str_pad(dechex($body_type), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($pos['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($pos['y']), 4, "0", STR_PAD_LEFT);
        $packet .= "00";
        $packet .= str_pad(dechex($pos['z']), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($pos['facing']), 2, "0", STR_PAD_LEFT);
        $packet .= "00FFFFFF";
        $packet .= "FF000000";
        $packet .= "00";
        $packet .= str_pad(dechex($map_size['x']), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($map_size['y']), 2, "0", STR_PAD_LEFT);
        $packet .= "0000";
        $packet .= "00000000";

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the skills information to the client
     */
    public function sendFullSkillList($runInLot = false) {
        // print_r($this->skills);
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
     * Update the cursor color of the client
     *
     * 0 = default
     * 1 = golden
     * 2 = ILSHENAR color?
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
        $packet = "BF003100180000000500000000000000000000000000000000000000000000000000000000000000000000000000000000";

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

        $packet = "78";
        $packet .= str_pad(dechex(23), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad($player->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->body), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->position['x']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->position['y']), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->position['z']), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->position['facing']), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->color), 4, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(0), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex(1), 2, "0", STR_PAD_LEFT);
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
        $packet .= str_pad(dechex($this->position['z']), 2, "0", STR_PAD_LEFT);
		
		echo str_pad($this->GetPacketFlags(), 2, "0", STR_PAD_LEFT)."\n\n";
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

        $oldPosition = $this->position;

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
        }

        $newPosition = $this->position;
        Map::updatePlayerLocation($this->client, $oldPosition, $newPosition);

        $packet = "22" . str_pad($sequence, 2, "0", STR_PAD_LEFT) . "01";
        Sockets::out($this->client, $packet, false);
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
        $packet .= str_pad(dechex($player->position['z']), 2, "0", STR_PAD_LEFT);
        $packet .= str_pad($direction, 2, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($player->color), 4, "0", STR_PAD_LEFT);
        $packet .= "00";
        $packet .= "01";

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
    public function statusBarInfo($runInLot = false) {
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
        $packet .= str_pad(dechex(5000), 8, "0", STR_PAD_LEFT);
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

        Sockets::out($this->client, $packet, $runInLot);
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
        Map::addPlayerToMap($this);
        Sockets::out($this->client, "55", $runInLot);
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

}
