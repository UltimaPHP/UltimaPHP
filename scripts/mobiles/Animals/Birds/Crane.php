<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class crane extends Mobile {
	public function summon() {
		$this->name = "a crane";
		$this->body = 254;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x4D7;
		$this->str = rand(26, 35);
		$this->dex = rand(16, 25);
		$this->int = rand(11, 15);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 1;
		$this->damage_max = 1;
		$this->resist_physical = rand(5, 5);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = 200;
		$this->fame = 0;
		$this->virtualarmor = 5;

}}
?>
