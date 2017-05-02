<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Cyclops extends Mobile {
	public function summon() {
		$this->name = "a cyclopean warrior";
		$this->body = 75;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(336, 385);
		$this->dex = rand(96, 115);
		$this->int = rand(31, 55);
		$this->maxhits = rand(202, 231);
		$this->hits = $this->maxhits;
		$this->damage = 7;
		$this->damageMax = 23;
		$this->resist_physical = rand(45, 50);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -4500;
		$this->fame = 4500;
		$this->virtualarmor = 48;

}}
?>
