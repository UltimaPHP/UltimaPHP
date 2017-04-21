<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class savage extends Mobile {
	public function summon() {
		$this->name = "savage";
		$this->body = 3;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x174;
		$this->str = rand(46, 70);
		$this->dex = rand(31, 50);
		$this->int = rand(26, 40);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 3;
		$this->damage_max = 7;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 15);
		$this->karma = -600;
		$this->fame = 600;
		$this->virtualarmor = 18;

}}
?>
