<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Kraken extends Mobile {
	public function summon() {
		$this->name = "a kraken";
		$this->body = 77;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(756, 780);
		$this->dex = rand(226, 245);
		$this->int = rand(26, 40);
		$this->hits = 19;
		$this->maxhits = 33;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(10, 20);
		$this->karma = -11000;
		$this->fame = 11000;
		$this->virtualarmor = 50;

}}
?>
