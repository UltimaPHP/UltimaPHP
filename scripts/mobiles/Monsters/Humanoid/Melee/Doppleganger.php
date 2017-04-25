<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Doppleganger extends Mobile {
	public function summon() {
		$this->name = "a doppleganger";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x451;
		$this->str = rand(81, 110);
		$this->dex = rand(56, 75);
		$this->int = rand(81, 105);
		$this->hits = 8;
		$this->maxhits = 12;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(30, 40);
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 55;

}}
?>
