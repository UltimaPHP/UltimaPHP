<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class FrostTroll extends Mobile {
	public function summon() {
		$this->name = "a frost troll";
		$this->body = 55;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(227, 265);
		$this->dex = rand(66, 85);
		$this->int = rand(46, 70);
		$this->hits = 14;
		$this->maxhits = 20;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = 0;
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 10);
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 50;

}}
?>
