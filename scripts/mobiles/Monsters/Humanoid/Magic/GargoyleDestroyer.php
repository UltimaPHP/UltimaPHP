<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GargoyleDestroyer extends Mobile {
	public function summon() {
		$this->name = "gargoyle destroyer";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x174;
		$this->str = rand(760, 850);
		$this->dex = rand(102, 150);
		$this->int = rand(152, 200);
		$this->hits = 7;
		$this->maxhits = 14;
		$this->resist_physical = rand(40, 60);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(15, 25);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 50;

}}
?>
