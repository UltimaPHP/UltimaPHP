<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class semidar extends Mobile {
	public function summon() {
		$this->name = "semidar";
		$this->body = 174;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x4B0;
		$this->str = rand(502, 600);
		$this->dex = rand(102, 200);
		$this->int = rand(601, 750);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 29;
		$this->damage_max = 35;
		$this->resist_physical = rand(20, 30);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(10, 20);
		$this->karma = -24000;
		$this->fame = 24000;
		$this->virtualarmor = 20;

}}
?>
