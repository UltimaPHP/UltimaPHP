<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Player {

	/* Server variables */
	public $client;

	/* Player variables */
	public $uid;
	public $serial;
	public $name;
	public $body;
	public $sex;
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
	public $resist_fire;
	public $resist_cold;
	public $resist_poison;
	public $resist_energy;
	public $luck;
	public $damage_min;
	public $damage_max;
	public $karma;
	public $fame;
	public $title;

	function __construct($client = null, $character_uid = null) {
		if (null === $client || null === $character_uid) {
			return false;
		}

		$this->client = $client;
		$this->uid = $character_uid;

		$query = "SELECT
                        a.id,
                        a.name,
                        a.body,
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
                        a.id = :player_uid";

		$sth = UltimaPHP::$db->prepare($query);
		$sth->execute(array(
			":player_uid" => $this->uid,
		));
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		if (isset($result[0])) {
			$position = explode(",", $result[0]['position']);

			$this->serial = str_pad(dechex(442500 + $this->uid), 8, "0", STR_PAD_LEFT);
			$this->name = $result[0]['name'];
			$this->body = $result[0]['body'];
			$this->sex = $result[0]['sex'];
			$this->race = $result[0]['race'];
			$this->position = array(
				'x' => $position[0],
				'y' => $position[1],
				'z' => $position[2],
				'map' => $position[3],
				'facing' => 6,
			);
			$this->hits = $result[0]['hits'];
			$this->maxhits = $result[0]['maxhits'];
			$this->mana = $result[0]['mana'];
			$this->maxmana = $result[0]['maxmana'];
			$this->stam = $result[0]['stam'];
			$this->maxstam = $result[0]['maxstam'];
			$this->str = $result[0]['str'];
			$this->maxstr = $result[0]['maxstr'];
			$this->int = $result[0]['int'];
			$this->maxint = $result[0]['maxint'];
			$this->dex = $result[0]['dex'];
			$this->maxdex = $result[0]['maxdex'];
			$this->statscap = $result[0]['statscap'];
			$this->pets = $result[0]['pets'];
			$this->maxpets = $result[0]['maxpets'];
			$this->resist_fire = $result[0]['resist_fire'];
			$this->resist_cold = $result[0]['resist_cold'];
			$this->resist_poison = $result[0]['resist_poison'];
			$this->resist_energy = $result[0]['resist_energy'];
			$this->luck = $result[0]['luck'];
			$this->damage_min = $result[0]['damage_min'];
			$this->damage_max = $result[0]['damage_max'];
			$this->karma = $result[0]['karma'];
			$this->fame = $result[0]['fame'];
			$this->title = $result[0]['title'];
		} else {
			UltimaPHP::$socketClients[$this->client]['account']->disconnect();
		}
	}

	/**
	 * Send to the client the locale and body information
	 */
	public function sendClientLocaleBody() {
		$body_type = $this->body;
		$pos = array(
			'x' => $this->position['x'],
			'y' => $this->position['y'],
			'z' => $this->position['z'],
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

		Sockets::out($this->client, $packet);
	}

	/**
	 * Send the skills information to the client
	 */
	public function sendFullSkillList() {
		$skills = 58;
		$tmpPacket = "02";
		for ($i = 1; $i <= 58; $i++) {
			$tmpPacket .= str_pad(dechex($i), 4, "0", STR_PAD_LEFT);
			$tmpPacket .= str_pad(dechex(1000), 4, "0", STR_PAD_LEFT);
			$tmpPacket .= str_pad(dechex(1000), 4, "0", STR_PAD_LEFT);
			$tmpPacket .= "00";
			$tmpPacket .= str_pad(dechex(1000), 4, "0", STR_PAD_LEFT);
		}
		$tmpPacket .= "0000";

		$packet = "3A";
		$packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 3), 4, "0", STR_PAD_LEFT);
		$packet .= $tmpPacket;

		Sockets::out($this->client, $packet);
	}

	/**
	 * Update the cursor color of the client
	 *
	 * 0 = default
	 * 1 = golden
	 * 2 = ILSHENAR color?
	 *
	 */
	public function updateCursorColor($color = 0) {
		$packet = "BF00060008" . str_pad(dechex($color), 2, "0", STR_PAD_LEFT);

		Sockets::out($this->client, $packet);
	}

	/**
	 * Send the information to client enable map diffs
	 */
	public function enableMapDiffs() {
		$packet = "BF310000180000000500000000000000000000000000000000000000000000000000000000000000000000000000000000";

		Sockets::out($this->client, $packet);
	}

	/**
	 * Send the client start to play music
	 */
	public function playMusic($music = null) {
		if (null === $music) {
			return false;
		}

		$packet = "6D" . str_pad(dechex($music), 4, "0", STR_PAD_LEFT);

		Sockets::out($this->client, $packet);
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
	public function setWeather($weather = null, $effect = 0, $temperature = 10) {
		if (null === $weather) {
			return false;
		}

		$packet = "65" . str_pad(dechex($weather), 2, "0", STR_PAD_LEFT) . str_pad(dechex($effect), 2, "0", STR_PAD_LEFT) . str_pad(dechex($temperature), 2, "0", STR_PAD_LEFT);

		Sockets::out($this->client, $packet);
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
	public function setSeasonal($season = null, $playSound = true) {
		if (null === $season) {
			return false;
		}

		$packet = "BC" . str_pad(dechex($season), 2, "0", STR_PAD_LEFT) . str_pad(dechex((int) $playSound), 2, "0", STR_PAD_LEFT);
		Sockets::out($this->client, $packet);
	}

	/**
	 * Send the light level to the client
	 * 0 = day
	 * 9 = OSI night
	 * 31 - Black (Max val)
	 */
	public function setLight($level = 0) {
		if ($level < 0) {
			$level = 0;
		}

		if ($level > 31) {
			$level = 31;
		}

		$packet = "4F" . str_pad(dechex($level), 2, "0", STR_PAD_LEFT);

		Sockets::out($this->client, $packet);
	}

	/**
	 * Drawn character on client
	 */
	public function drawChar() {
		$packet = "78";
		$packet .= str_pad(dechex(30), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->position['x']), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->position['y']), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->position['z']), 2, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->position['facing']), 2, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex(33770), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex(24), 2, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex(7), 2, "0", STR_PAD_LEFT);
		$packet .= "400551800E7515";

		// Backpack
		$packet .= "00000000";

		Sockets::out($this->client, $packet);
	}

	/**
	 * Draw the player on client
	 */
	public function drawPlayer() {
		$packet = "20";
		$packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->body), 4, "0", STR_PAD_LEFT);
		$packet .= "00";
		$packet .= str_pad(dechex(33770), 4, "0", STR_PAD_LEFT);
		$packet .= "18";
		$packet .= str_pad(dechex($this->position['x']), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->position['y']), 4, "0", STR_PAD_LEFT);
		$packet .= "0000";
		$packet .= str_pad(dechex($this->position['facing']), 2, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->position['z']), 2, "0", STR_PAD_LEFT);

		Sockets::out($this->client, strtoupper($packet));
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
	public function mountSpeed($speed = 0) {
		$packet = "BF00060026" . str_pad(dechex($speed), 2, "0", STR_PAD_LEFT);

		Sockets::out($this->client, $packet);
	}

	/**
	 * Update the client status bar information
	 */
	public function updateStatusBar() {
		$packet = "17";
		$packet .= "000F";
		$packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
		$packet .= "0002000100000200";

		Sockets::out($this->client, $packet);
	}

	/**
	 * Update the status bar information on the client
	 */
	public function statusBarInfo() {
		$packet = "11";
		$packet = "005B";
		$packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
		$packet .= str_pad($this->name, 30, "0", STR_PAD_RIGHT);
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
		$packet .= str_pad(dechex($this->race), 4, "0", STR_PAD_LEFT);
		if ($this->statscap > 0) {
			$packet .= str_pad(dechex($this->statscap), 4, "0", STR_PAD_LEFT);
		} else {
			$packet .= "0000";
		}
		$packet .= str_pad(dechex($this->pets), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->maxpets), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->resist_fire), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->resist_cold), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->resist_poison), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->resist_energy), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->luck), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->damage_min), 4, "0", STR_PAD_LEFT);
		$packet .= str_pad(dechex($this->damage_max), 4, "0", STR_PAD_LEFT);
		$packet .= "00000000";

		Sockets::out($this->client, $packet);
	}

	/**
	 * Send extended stats to the client
	 */
	public function extendedStats($flag = 0) {
		if (is_array($flag) && count($flag) == 0) {
			$flag = 0;
		}

		$packet = "BF000C001902" . str_pad($this->serial, 8, "0", STR_PAD_LEFT) . "00" . str_pad(dechex($flag), 2, "0", STR_PAD_LEFT);

		Sockets::out($this->client, $packet);
	}

	/**
	 * Set war mode on client
	 *
	 * 0 = Peace
	 * 1 = Fighting
	 *
	 */
	public function setWarMode($warmode = 0) {
		$packet = "72";
		$packet .= str_pad(dechex($warmode), 2, "0", STR_PAD_LEFT);
		$packet .= "003200";

		Sockets::out($this->client, $packet);
	}

	/**
	 * Send the login complete confirmation to the client
	 */
	public function confirmLogin() {
		$packet = "55";

		Sockets::out($this->client, $packet);
	}
}
