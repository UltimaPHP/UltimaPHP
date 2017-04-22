<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class seaserpent extends Mobile {
	public function summon() {
		$this->name = "a sea serpent";
		$this->body = 150;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(168, 225);
		$this->dex = rand(58, 85);
		$this->int = rand(53, 95);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 7;
		$this->damage_max = 13;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(15, 20);
		$this->karma = -6000;
		$this->fame = 6000;
		$this->virtualarmor = 30;

}}
?>
