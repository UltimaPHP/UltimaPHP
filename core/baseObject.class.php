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
		"modifiers" => array()
	);

	public $dispid = array(
		"base",
		"modifier"
	);

	public $container = array(
		"X" => 0,
		"Y" => 0,
		"Z" => 0,
		"container" => 0,
		"server" => 0
	);

	public $hits = array(
		"base" => 10,
		"Max" => 10,
		"modifiers" => array()
	);

	public $mana = array(
		"base" => 10,
		"Max" => 10,
		"modifiers" => array()
	);

	public $stamina = array(
		"base" => 10,
		"Max" => 10,
		"modifiers" => array()
	);

	public $strength = array(
		"base" => 10,
		"Max" => 10,
		"modifiers1" => array(),
		"modifiers2" => array()
	);

	public $inttelligence = array(
		"base" => 10,
		"Max" => 10,
		"modifiers1" => array(),
		"modifiers2" => array()
	);

	public $dexterity = array(
		"base" => 10,
		"Max" => 10,
		"modifiers1" => array(),
		"modifiers2" => array()
	);

	public $movespeed = array(
		"walk" => array(
			"base" => 10,
			"modifiers" => array()
		),
		"run" => array(
			"base" => 10,
			"modifiers" => array()
		),
		"swim" => array(
			"base" => 10,
			"modifiers" => array()
		),
		"fly" => array(
			"base" => 10,
			"modifiers" => array()
		)
	);

	public $weight = array(
		"base" => 10,
		"Max" => 10,
		"modifiers" => array()
	);

	public $pets = array(
		"base" => 1,
		"modifiers" => array()
	);

	public $resist = array(
		"fire" => array(
			"base" => 0,
			"modifiers" => array()
		),
		"cold" => array(
			"base" => 0,
			"modifiers" => array()
		),
		"poison" => array(
			"base" => 0,
			"modifiers" => array()
		),
		"energy" => array(
			"base" => 0,
			"modifiers" => array()
		)
	);

	public $luck = array(
		"base" => 10,
		"modifiers" => array()
	);

	public $damage = array(
		"base" => 10,
		"modifiers" => array()
	);

	public $title = array(
		"base",
		"Original",
		"modifiers" => array()
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
