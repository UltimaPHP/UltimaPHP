<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Gibberling extends Mobile {
	public function summon() {
		$this->name = "a gibberling";
		$this->body = 307;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(141, 165);
		$this->dex = rand(101, 125);
		$this->int = rand(56, 80);
		$this->hits = 12;
		$this->maxhits = 17;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(30, 40);
		$this->karma = -1500;
		$this->fame = 1500;
		$this->virtualarmor = 27;

}}
?>
