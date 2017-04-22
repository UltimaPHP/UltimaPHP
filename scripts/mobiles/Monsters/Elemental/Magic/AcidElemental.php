<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class acidelemental extends Mobile {
	public function summon() {
		$this->name = "an acid elemental";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(326, 355);
		$this->dex = rand(66, 85);
		$this->int = rand(271, 295);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 9;
		$this->damage_max = 15;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(30, 40);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 40;

}}
?>
