<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BullFrog extends Mobile {
	public function summon() {
		$this->name = "a bull frog";
		$this->body = 81;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x266;
		$this->str = rand(46, 70);
		$this->dex = rand(6, 25);
		$this->int = rand(11, 20);
		$this->hits = 1;
		$this->maxhits = 2;
		$this->resist_physical = rand(5, 10);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = 0;
		$this->fame = 350;
		$this->virtualarmor = 6;

}}
?>
