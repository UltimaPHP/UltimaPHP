<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SkitteringHopper extends Mobile {
	public function summon() {
		$this->name = "a skittering hopper";
		$this->body = 302;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(41, 65);
		$this->dex = rand(91, 115);
		$this->int = rand(26, 50);
		$this->hits = 3;
		$this->maxhits = 5;
		$this->resist_physical = rand(5, 10);
		$this->resist_fire = 0;
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = 0;
		$this->resist_energy = rand(5, 10);
		$this->karma = 0;
		$this->fame = 300;
		$this->virtualarmor = 12;

}}
?>
