<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SavageRider extends Mobile {
	public function summon() {
		$this->name = "savage rider";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(151, 170);
		$this->dex = rand(92, 130);
		$this->int = rand(51, 65);
		$this->hits = 29;
		$this->maxhits = 34;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 0;

}}
?>
