<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class mongbat extends Mobile {
	public function summon() {
		$this->name = "a mongbat";
		$this->body = 39;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(6, 10);
		$this->dex = rand(26, 38);
		$this->int = rand(6, 14);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 1;
		$this->damage_max = 2;
		$this->resist_physical = rand(5, 10);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -150;
		$this->fame = 150;
		$this->virtualarmor = 10;

}}
?>
