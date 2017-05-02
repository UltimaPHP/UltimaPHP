<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Panther extends Mobile {
	public function summon() {
		$this->name = "a panther";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x462;
		$this->str = rand(61, 85);
		$this->dex = rand(86, 105);
		$this->int = rand(26, 50);
		$this->maxhits = rand(37, 51);
		$this->hits = $this->maxhits;
		$this->damage = 4;
		$this->damageMax = 12;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(10, 15);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = 0;
		$this->karma = 0;
		$this->fame = 450;
		$this->virtualarmor = 16;

}}
?>
