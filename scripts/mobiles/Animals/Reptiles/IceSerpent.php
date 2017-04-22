<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class iceserpent extends Mobile {
	public function summon() {
		$this->name = "a giant ice serpent";
		$this->body = 89;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(216, 245);
		$this->dex = rand(26, 50);
		$this->int = rand(66, 85);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 7;
		$this->damage_max = 17;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = 0;
		$this->resist_cold = rand(80, 90);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(10, 20);
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 32;

}}
?>
