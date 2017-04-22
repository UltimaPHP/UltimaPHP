<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class harpy extends Mobile {
	public function summon() {
		$this->name = "a harpy";
		$this->body = 30;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(96, 120);
		$this->dex = rand(86, 110);
		$this->int = rand(51, 75);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 7;
		$this->resist_physical = rand(25, 30);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(10, 30);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(10, 20);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 28;

}}
?>
