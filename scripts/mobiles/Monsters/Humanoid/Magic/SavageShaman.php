<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SavageShaman extends Mobile {
	public function summon() {
		$this->name = "savage shaman";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(126, 145);
		$this->dex = rand(91, 110);
		$this->int = rand(161, 185);
		$this->hits = 4;
		$this->maxhits = 10;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(40, 50);
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 0;

}}
?>
