<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class IceFiend extends Mobile {
	public function summon() {
		$this->name = "an ice fiend";
		$this->body = 43;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(376, 405);
		$this->dex = rand(176, 195);
		$this->int = rand(201, 225);
		$this->hits = 8;
		$this->maxhits = 19;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(60, 70);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(30, 40);
		$this->karma = -18000;
		$this->fame = 18000;
		$this->virtualarmor = 60;

}}
?>
