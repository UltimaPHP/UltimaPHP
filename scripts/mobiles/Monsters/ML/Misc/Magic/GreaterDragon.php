<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GreaterDragon extends Mobile {
	public function summon() {
		$this->name = "a greater dragon";
		$this->body = 12;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(1025, 1425);
		$this->dex = rand(81, 148);
		$this->int = rand(475, 675);
		$this->hits = 24;
		$this->maxhits = 33;
		$this->resist_physical = rand(60, 85);
		$this->resist_fire = rand(65, 90);
		$this->resist_cold = rand(40, 55);
		$this->resist_poison = rand(40, 60);
		$this->resist_energy = rand(50, 75);
		$this->karma = -15000;
		$this->fame = 22000;
		$this->virtualarmor = 60;

}}
?>
