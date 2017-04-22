<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class reaper extends Mobile {
	public function summon() {
		$this->name = "a reaper";
		$this->body = 47;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(66, 215);
		$this->dex = rand(66, 75);
		$this->int = rand(101, 250);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 9;
		$this->damage_max = 11;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(30, 40);
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 40;

}}
?>
