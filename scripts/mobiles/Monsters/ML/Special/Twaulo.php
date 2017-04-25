<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Twaulo extends Mobile {
	public function summon() {
		$this->name = "twaulo";
		$this->body = 101;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(1751, 1950);
		$this->dex = rand(251, 450);
		$this->int = rand(801, 1000);
		$this->hits = 19;
		$this->maxhits = 24;
		$this->resist_physical = rand(65, 75);
		$this->resist_fire = rand(45, 55);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(50, 60);
		$this->karma = 50000;
		$this->fame = 50000;
		$this->virtualarmor = 50;

}}
?>
