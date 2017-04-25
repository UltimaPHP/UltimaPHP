<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class StoneGargoyle extends Mobile {
	public function summon() {
		$this->name = "a stone gargoyle";
		$this->body = 67;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x174;
		$this->str = rand(246, 275);
		$this->dex = rand(76, 95);
		$this->int = rand(81, 105);
		$this->hits = 11;
		$this->maxhits = 17;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 50;

}}
?>
