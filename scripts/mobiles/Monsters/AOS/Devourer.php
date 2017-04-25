<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Devourer extends Mobile {
	public function summon() {
		$this->name = "a devourer of souls";
		$this->body = 303;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(801, 950);
		$this->dex = rand(126, 175);
		$this->int = rand(201, 250);
		$this->hits = 22;
		$this->maxhits = 26;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(40, 50);
		$this->karma = -9500;
		$this->fame = 9500;
		$this->virtualarmor = 44;

}}
?>
