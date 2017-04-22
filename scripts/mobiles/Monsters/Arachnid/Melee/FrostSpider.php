<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class frostspider extends Mobile {
	public function summon() {
		$this->name = "a frost spider";
		$this->body = 20;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x388;
		$this->str = rand(76, 100);
		$this->dex = rand(126, 145);
		$this->int = rand(36, 60);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 6;
		$this->damage_max = 16;
		$this->resist_physical = rand(25, 30);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(10, 20);
		$this->karma = -775;
		$this->fame = 775;
		$this->virtualarmor = 28;

}}
?>
