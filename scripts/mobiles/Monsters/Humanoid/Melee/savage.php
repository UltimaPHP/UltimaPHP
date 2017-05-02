<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Savage extends Mobile {
	public function summon() {
		$this->name = "savage";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(96, 115);
		$this->dex = rand(86, 105);
		$this->int = rand(51, 65);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 23;
		$this->damageMax = 27;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 0;

}}
?>
