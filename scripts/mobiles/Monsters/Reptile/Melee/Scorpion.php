<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class scorpion extends Mobile {
	public function summon() {
		$this->name = "a scorpion";
		$this->body = 48;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(73, 115);
		$this->dex = rand(76, 95);
		$this->int = rand(16, 30);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 10;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(10, 15);
		$this->resist_cold = rand(20, 25);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(10, 15);
		$this->karma = -2000;
		$this->fame = 2000;
		$this->virtualarmor = 28;

}}
?>
