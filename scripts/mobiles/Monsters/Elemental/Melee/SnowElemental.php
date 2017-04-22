<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class snowelemental extends Mobile {
	public function summon() {
		$this->name = "a snow elemental";
		$this->body = 163;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(326, 355);
		$this->dex = rand(166, 185);
		$this->int = rand(71, 95);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 11;
		$this->damage_max = 17;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(10, 15);
		$this->resist_cold = rand(60, 70);
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(25, 35);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 50;

}}
?>
