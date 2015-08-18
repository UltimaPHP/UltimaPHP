<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Modifiers Help:
 * array(method, string)
 *
 */
class BaseObject {

	/* Server variables */
	public $client;

	/* Player variables */
	public $UID;

	public $name = array(
		"base",
		"modifiers" => array(),
	);

	public $dispid = array(
		"base",
		"modifier",
	);

	public $container = array(
		"X" => 0,
		"Y" => 0,
		"Z" => 0,
		"container" => 0,
		"server" => 0,
	);

	public $hits = array(
		"base" => 10,
		"Max" => 10,
		"modifiers" => array(),
	);

	public $mana = array(
		"base" => 10,
		"Max" => 10,
		"modifiers" => array(),
	);

	public $stamina = array(
		"base" => 10,
		"Max" => 10,
		"modifiers" => array(),
	);

	public $strength = array(
		"base" => 10,
		"Max" => 10,
		"modifiers1" => array(),
		"modifiers2" => array(),
	);

	public $inttelligence = array(
		"base" => 10,
		"Max" => 10,
		"modifiers1" => array(),
		"modifiers2" => array(),
	);

	public $dexterity = array(
		"base" => 10,
		"Max" => 10,
		"modifiers1" => array(),
		"modifiers2" => array(),
	);

	public $movespeed = array(
		"walk" => array(
			"base" => 10,
			"modifiers" => array(),
		),
		"run" => array(
			"base" => 10,
			"modifiers" => array(),
		),
		"swim" => array(
			"base" => 10,
			"modifiers" => array(),
		),
		"fly" => array(
			"base" => 10,
			"modifiers" => array(),
		),
	);

	public $weight = array(
		"base" => 10,
		"Max" => 10,
		"modifiers" => array(),
	);

	public $pets = array(
		"base" => 1,
		"modifiers" => array(),
	);

	public $resist = array(
		"fire" => array(
			"base" => 0,
			"modifiers" => array(),
		),
		"cold" => array(
			"base" => 0,
			"modifiers" => array(),
		),
		"poison" => array(
			"base" => 0,
			"modifiers" => array(),
		),
		"energy" => array(
			"base" => 0,
			"modifiers" => array(),
		),
	);

	public $luck = array(
		"base" => 10,
		"modifiers" => array(),
	);

	public $damage = array(
		"base" => 10,
		"modifiers" => array(),
	);

	/**
	 * Faction list
	 *
	 * Faction Order        = Default faction
	 * Faction Chaos        = Default faction
	 * Order Of the Ether   = Magicians Clan... high karma required to enter wind.
	 * Shadow Walkers       = Brigands (thieves, necromancers, and nefarious types) Guild
	 * Order Of the Avatar  = British Guild
	 * Order Of the Moon    = Elven Clan
	 * Clan Dracon          = Dragon Clan
	 * Clan Mogra           = Lizardman Clan
	 * Clan Mogra           = RatMan Clan
	 * Clan Mogra           = XYZ Clan
	 * Clan Piggu           = XYZ Clan
	 * Clan Shulhug         = XYZ Clan
	 * Clan Zorfu           = XYZ Clan
	 * Clan Dregu           = XYZ Clan
	 * Clan Wumanok         = XYZ Clan
	 * Clan Korgak          = XYZ Clan
	 * Clan Shagrol         = XYZ Clan
	 * Clan Vruhag          = XYZ Clan
	 * Clan Clog            = XYZ Clan
	 * Clan Zuhgan          = XYZ Clan
	 * Clan Avalon          = Good but misunderstood Gargoyle Clan, ()players, vendors, and questers)
	 * Clan Laburinth       = Evil Gargoyle Clan Dungeon type gargoyles... they hate everyone. Has need to destroy world
	 */
	public $factions = array(
		'faction order' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'faction chaos' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'order of the ether' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'shadow walkers' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'order of the avatar' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'order of the moon' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan dracon' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan mogra' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan piggu' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan shulhug' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan zorfu' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan dregu' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan wumanok' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan korgak' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan shagrol' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan vruhag' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan clog' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan zuhgan' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan avalon' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
		'clan laburinth' => array(
			"karma" => array(
				"base" => 0,
				"modifiers" => array(),
			),
			"fame" => array(
				"base" => 0,
				"modifiers" => array(),
			),
		),
	);

	/**
	 * Language List
	 *
	 * sosarian             = Human language of Tramell
	 * archaic              = Language of Felucca, undead, and demonic
	 * delucan              = Human language of the lost lands
	 * lunan                = Language of inhabitants of Luna
	 * umbran               = Dark language of Umbra
	 * tokunan              = Language of humans from Tokuno
	 * draconian            = Language of Dragon Kind
	 * reptilian            = Lizardman language
	 * ophidian             = Languague of snake kind
	 * mogran               = Dialect of Orcish
	 * piggush              = Dialect of Orcish
	 * shulhug'n            = Dialect of Orcish
	 * zorfun               = Dialect of Orcish
	 * dregun               = Dialect of Orcish
	 * wumanok              = Dialect of Orcish
	 * korgan               = Dialect of Orcish
	 * shagrol              = Dialect of Orcish
	 * vruhag               = Dialect of Orcish
	 * clog                 = Dialect of Orcish
	 * zughan               = Dialect of Orcish
	 * drollish             = Troll language
	 * titan                = Language of the giant races
	 * elvish               = Elf language
	 * gargish              = Gargoyle Language
	 * ratian               = Language of the ratmen
	 * t'click              = spider language
	 * minotian             = Minotaur language
	 * meerish              = Meer language
	 * entish               = Meer language
	 */

	public $language = array(
		'sosarian' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'archaic' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'delucan' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'lunan' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'umbran' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'tokunan' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'draconian' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'reptilian' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'ophidian' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'mogran' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'piggush' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		"shulhug'n" => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'zorfun' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'dregun' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'wumanok' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'korgan' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'shagrol' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'vruhag' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'clog' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'zughan' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'drollish' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'titan' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'elvish' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'gargish' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		'ratian' => array(
			"base" => 0,
			"modifiers" => array(),
		),
		"t'click" => array(
			"base" => 0,
			"modifiers" => array(),
		),
		"minotian" => array(
			"base" => 0,
			"modifiers" => array(),
		),
		"meerish" => array(
			"base" => 0,
			"modifiers" => array(),
		),
		"entish" => array(
			"base" => 0,
			"modifiers" => array(),
		),
	);

	public $title = array(
		"base",
		"Original",
		"modifiers" => array(),
	);

	// Class constructor
	public function __construct() {

		//Number of seconds to move to the next tile when walking
		$this->newStat("walkspeed", 0.5, array());

		//Number of seconds to move to the next tile when running
		$this->newStat("runspeed", 0.9, array());

		//Number of seconds to move to the next tile when Flying
		$this->newStat("flyspeed", 0, array());

		//Number of seconds to move to the next tile when Swimming
		$this->newStat("swimspeed", 0, array());

		//fight stats
		$this->newStat("hitchance", 0, array());

		//Chance to hit target in percentage
		$this->newStat("swingspeed", 0, array());

		//Events::AddEvent(array(array($this,"DoAI"), array(1)), ['MasterTiming']);

	}

	// Set makes it return a different name used for disguises. Pre sets what comes before the name, post sets what comes after.
	public function getName() {
		$name = $this->name['base'];
		foreach ($this->name['modifiers'] as $k => $v) {
			if ("set" === $v[0]) {
				$name = $v[0];
			} elseif ("pre" === $v[0]) {
				$name = $v[0] . " " . $name;
			} else {
				$name .= " " . $v[0];
			}
		}
		return $name;
	}

	// Set makes it return a different name used for disguises. Pre sets what comes before the name, post sets what comes after.
	public function setName() {
		$this->name['base'] = $name;
		return $this->name['base'];
	}

	// Returns current Hits points and the current max plus the max modifiers
	public function getHitsPoints() {
		$hits = $this->hits['base'];
		$maxHits = $this->hits['max'];

		foreach ($this->hits['modifiers'] as $k => $v) {
			if ('set' === $v[0]) {
				$maxHits = $v[1];
			} else {
				$maxHits = $maxHits + $v[1];
			}
		}

		// Reset the Hits points, no Hits points below min
		if ($maxHits < 0) {
			$maxHits = 0;
		}

		// Reset the Hits points, no Hits points above max
		if ($hits > $maxHits) {
			$hits = $maxHits;
			$this->hits['base'] = $maxHits;
		}
		return array(
			$hits,
			$maxHits,
		);
	}

	// Set the hits modifier
	public function hitsModifier($id, $Method, $Amount) {
		$this->hits['modifiers'][$id][0] = $Method;
		$this->hits['modifiers'][$id][1] = $Amount;
	}

	// Set current Hits points and the current max plus the max modifiers
	public function setHitsPoints($in) {
		$this->hits['base'] = $in;
		$maxHits = $this->hits['max'];
		foreach ($this->hits['modifiers'] as $k => $v) {
			if ('set' === $v[0]) {
				$maxHits = $v[1];
			} else {
				$maxHits = $maxHits + $v[1];
			}
		}

		// Reset the Hits points, no Hits points below min
		if ($maxHits < 0) {
			$maxHits = 0;
		}

		// Reset the Hits points, no Hits points above max
		if ($hits > $maxHits) {
			$hits = $maxHits;
			$this->hits['base'] = $maxHits;
		}
	}

	// returns current Mana points and the current max plus the max modifiers
	public function getManaPoints() {
		$mana = $this->mana['base'];
		$maxMana = $this->mana['max'];

		foreach ($this->mana['modifiers'] as $k => $v) {
			if ('set' === $v[0]) {
				$maxMana = $v[1];
			} else {
				$maxMana = $maxMana + $v[1];
			}
		}

		// Reset the Mana points, no Mana points below min
		if ($maxMana < 0) {
			$maxMana = 0;
		}

		// Reset the Mana points, no Mana points above max
		if ($mana > $maxMana) {
			$mana = $maxMana;
			$this->mana['base'] = $maxMana;
		}
		return array(
			$mana,
			$maxMana,
		);
	}

	// Set the mana modifier
	public function manaModifier($id, $Method, $Amount) {
		$this->mana['modifiers'][$id][0] = $Method;
		$this->mana['modifiers'][$id][1] = $Amount;
	}

	// Set current Hits points and the current max plus the max modifiers
	public function setManaPoints($in) {
		$this->mana['base'] = $in;
		$maxMana = $this->mana['max'];
		foreach ($this->mana['modifiers'] as $k => $v) {
			if ('set' === $v[0]) {
				$maxMana = $v[1];
			} else {
				$maxMana = $maxMana + $v[1];
			}
		}

		// Reset the Mana points, no Mana points below min
		if ($maxMana < 0) {
			$maxMana = 0;
		}

		// Reset the Mana points, no Mana points above max
		if ($mana > $maxMana) {
			$mana = $maxMana;
			$this->mana['base'] = $maxMana;
		}
	}

	// Returns current Stamina points and the current max plus the max modifiers
	public function getStaminaPoints() {
		$stamina = $this->stamina['base'];
		$maxStamina = $this->stamina['max'];

		foreach ($this->stamina['modifiers'] as $k => $v) {
			if ('set' === $v[0]) {
				$maxStamina = $v[1];
			} else {
				$maxStamina = $maxStamina + $v[1];
			}
		}

		// Reset the Stamina points, no Stamina points below min
		if ($maxStamina < 0) {
			$maxStamina = 0;
		}

		// Reset the Stamina points, no Stamina points above max
		if ($stamina > $maxStamina) {
			$stamina = $maxStamina;
			$this->stamina['base'] = $maxStamina;
		}
		return array(
			$stamina,
			$maxStamina,
		);
	}

	// Set the stamina modifier
	public function staminaModifier($id, $Method, $Amount) {
		$this->stamina['modifiers'][$id][0] = $Method;
		$this->stamina['modifiers'][$id][1] = $Amount;
	}

	// Set current stamina points and the current max plus the max modifiers
	public function setStaminaPoints($in) {
		$this->stamina['base'] = $in;
		$maxStamina = $this->stamina['max'];
		foreach ($this->stamina['modifiers'] as $k => $v) {
			if ('set' === $v[0]) {
				$maxStamina = $v[1];
			} else {
				$maxStamina = $maxStamina + $v[1];
			}
		}

		// Reset the Stamina points, no Stamina points below min
		if ($maxStamina < 0) {
			$maxStamina = 0;
		}

		// Reset the Stamina points, no Stamina points above max
		if ($stamina > $maxStamina) {
			$stamina = $maxStamina;
			$this->stamina['base'] = $maxStamina;
		}
	}

	// Set makes it return a different name used for disguises. Pre sets what comes before the name, post sets what comes after.
	public function addNameModifier($id, $method, $string) {
		$this->name['modifiers'][$id][0] = $method;
		$this->name['modifiers'][$id][1] = $string;
	}

	// Returns the base and the total modifiers.
	public function getFactionKarma($name) {
		$key = "Karma";
		if (isset($this->factions[$name])) {
			$value = $this->factions[$name][$key]['base'];
			foreach ($this->factions[$name][$key]['modifiers'] as $k => $v) {
				if ("set" === $v[0]) {
					$value = $v[1];
				} else {
					$value = $value + $v[1];
				}
			}
			return array(
				$this->factions[$name][$key]['base'],
				$value,
			);
		} else {
			return false;
		}
	}

	// Returns the base and the total modifiers.
	public function getFactionFame($name) {
		$key = "fame";
		if (isset($this->factions[$name])) {
			$value = $this->factions[$name][$key]['base'];
			foreach ($this->factions[$name][$key]['modifiers'] as $k => $v) {
				if ("set" === $v[0]) {
					$value = $v[1];
				} else {
					$value = $value + $v[1];
				}
			}
			return array(
				$this->factions[$name][$key]['base'],
				$value,
			);
		} else {
			return false;
		}
	}

	// Sets the base number of the faction.
	public function setFactionKarma($name, $amount) {
		$key = "Karma";
		if ($amount < 0) {
			return false;
		} elseif (isset($this->factions[$name])) {
			$this->factions[$name][$key]['base'] = $amount;
			return $this->factions[$name][$key]['base'];
		} else {
			return false;
		}
	}

	// Sets the base number of the faction.
	public function setFactionFame($name, $amount) {
		$key = "fame";
		if ($amount < 0) {
			return false;
		} elseif (isset($this->factions[$name])) {
			$this->factions[$name][$key]['base'] = $amount;
			return $this->factions[$name][$key]['base'];
		} else {
			return false;
		}
	}

	// Sets the base number of the faction.
	public function setFactionFameModifier($name, $id, $method, $amount) {
		$key = "fame";
		if ($amount < 0) {
			return false;
		} elseif (isset($this->factions[$name])) {
			$this->factions[$name][$key]['modifiers'][$id][0] = $method;
			$this->factions[$name][$key]['modifiers'][$id][1] = $amount;
		} else {
			return false;
		}
	}

	// Sets the base number of the faction.
	public function setFactionKarmaModifier($name, $id, $method, $amount) {
		$key = "fame";
		if ($amount < 0) {
			return false;
		} elseif (isset($this->factions[$name])) {
			$this->factions[$name][$key]['modifiers'][$id][0] = $method;
			$this->factions[$name][$key]['modifiers'][$id][1] = $amount;
		} else {
			return false;
		}
	}

	public function swungAt($Who) {
	}

	public function damage($Damage, $type, $from) {
	}

	public function hit($damage, $type, $from) {
	}

	public function cast($spell, $from, $level) {
	}

	public function moveXYZ($type, $x, $y, $z, $container, $server) {
	}

	public function moveregion($RegionName) {
	}

	public function dClickItem($what) {
	}

	public function click($whoClicked) {
	}

	public function dClick($whoDclicked) {
	}

	public function stand($what) {
	}

	public function steppedOn($bywho) {
		if ($bywho !== $this->UID) {
		}
	}
}
