<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class bogthing extends Mobile {
	public function summon() {
		$this->name = "a bog thing";
		$this->body = 780;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(801, 900);
		$this->dex = rand(46, 65);
		$this->int = rand(36, 50);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 10;
		$this->damage_max = 23;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(20, 25);
		$this->resist_cold = rand(10, 15);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(20, 25);
		$this->karma = -8000;
		$this->fame = 8000;
		$this->virtualarmor = 28;

}}
?>
