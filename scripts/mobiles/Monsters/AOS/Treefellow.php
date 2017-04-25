<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Treefellow extends Mobile {
	public function summon() {
		$this->name = "a treefellow";
		$this->body = 301;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(196, 220);
		$this->dex = rand(31, 55);
		$this->int = rand(66, 90);
		$this->hits = 12;
		$this->maxhits = 16;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = 0;
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(30, 35);
		$this->resist_energy = rand(20, 30);
		$this->karma = 1500;
		$this->fame = 500;
		$this->virtualarmor = 24;

}}
?>
