<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class DireWolf extends Mobile {
	public function summon() {
		$this->name = "a dire wolf";
		$this->body = 23;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xE5;
		$this->str = rand(96, 120);
		$this->dex = rand(81, 105);
		$this->int = rand(36, 60);
		$this->hits = 11;
		$this->maxhits = 17;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(5, 10);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(10, 15);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 22;

}}
?>
