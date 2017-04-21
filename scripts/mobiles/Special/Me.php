<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class me extends Mobile {
	public function summon() {
		$this->name = "me";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x467;
		$this->str = rand(253, 400);
		$this->dex = rand(157, 850);
		$this->int = rand(503, 800);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 27;
		$this->damage_max = 38;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(40, 50);
		$this->karma = 20000;
		$this->fame = 20000;
		$this->virtualarmor = 50;

}}
?>
