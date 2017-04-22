<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class pestilentbandage extends Mobile {
	public function summon() {
		$this->name = "a pestilent bandage";
		$this->body = 154;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(691, 740);
		$this->dex = rand(141, 180);
		$this->int = rand(51, 80);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 13;
		$this->damage_max = 23;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(20, 30);
		$this->karma = -20000;
		$this->fame = 20000;
		$this->virtualarmor = 28;

}}
?>
