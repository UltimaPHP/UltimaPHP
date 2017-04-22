<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class stoneharpy extends Mobile {
	public function summon() {
		$this->name = "a stone harpy";
		$this->body = 73;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(296, 320);
		$this->dex = rand(86, 110);
		$this->int = rand(51, 75);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 8;
		$this->damage_max = 16;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -4500;
		$this->fame = 4500;
		$this->virtualarmor = 50;

}}
?>
