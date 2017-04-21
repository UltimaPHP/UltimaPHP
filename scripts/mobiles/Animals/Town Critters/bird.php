<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class bird extends Mobile {
	public function summon() {
		$this->name = "bird";
		$this->body = 238;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xCC;
		$this->str = rand(27, 37);
		$this->dex = rand(28, 43);
		$this->int = rand(29, 37);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 1;
		$this->damage_max = 2;
		$this->resist_physical = rand(5, 10);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = 0;
		$this->karma = -150;
		$this->fame = 150;
		$this->virtualarmor = 6;

}}
?>
