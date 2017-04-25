<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class EvilMage extends Mobile {
	public function summon() {
		$this->name = "evil mage";
		$this->body = 124;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(81, 105);
		$this->dex = rand(91, 115);
		$this->int = rand(96, 120);
		$this->hits = 5;
		$this->maxhits = 10;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = 0;
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 10);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 16;

}}
?>
