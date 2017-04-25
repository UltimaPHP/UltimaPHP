<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Pixie extends Mobile {
	public function summon() {
		$this->name = "pixie";
		$this->body = 128;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x467;
		$this->str = rand(21, 30);
		$this->dex = rand(301, 400);
		$this->int = rand(201, 250);
		$this->hits = 9;
		$this->maxhits = 15;
		$this->resist_physical = rand(80, 90);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(40, 50);
		$this->karma = 7000;
		$this->fame = 7000;
		$this->virtualarmor = 100;

}}
?>
