<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GiantSerpent extends Mobile {
	public function summon() {
		$this->name = "a giant serpent";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(186, 215);
		$this->dex = rand(56, 80);
		$this->int = rand(66, 85);
		$this->hits = 7;
		$this->maxhits = 17;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(70, 90);
		$this->resist_energy = rand(10, 20);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 32;

}}
?>
