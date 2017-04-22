<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class deathwatchbeetle extends Mobile {
	public function summon() {
		$this->name = "a deathwatch beetle";
		$this->body = 242;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(136, 160);
		$this->dex = rand(41, 52);
		$this->int = rand(31, 40);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 10;
		$this->resist_physical = rand(35, 40);
		$this->resist_fire = rand(15, 30);
		$this->resist_cold = rand(15, 30);
		$this->resist_poison = rand(50, 80);
		$this->resist_energy = rand(20, 35);
		$this->karma = -1400;
		$this->fame = 1400;
		$this->virtualarmor = 0;

}}
?>
