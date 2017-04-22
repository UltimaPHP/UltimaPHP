<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class terathanavenger extends Mobile {
	public function summon() {
		$this->name = "a terathan avenger";
		$this->body = 152;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x24D;
		$this->str = rand(467, 645);
		$this->dex = rand(77, 95);
		$this->int = rand(126, 150);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 18;
		$this->damage_max = 22;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(35, 45);
		$this->resist_poison = rand(90, 100);
		$this->resist_energy = rand(35, 45);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 50;

}}
?>
