<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class troglodyte extends Mobile {
	public function summon() {
		$this->name = "a troglodyte";
		$this->body = 267;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x59F;
		$this->str = rand(148, 217);
		$this->dex = rand(91, 120);
		$this->int = rand(51, 70);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 11;
		$this->damage_max = 14;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(35, 40);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 28;

}}
?>
