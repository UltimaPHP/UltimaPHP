<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class eldergazer extends Mobile {
	public function summon() {
		$this->name = "an elder gazer";
		$this->body = 22;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(296, 325);
		$this->dex = rand(86, 105);
		$this->int = rand(291, 385);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 8;
		$this->damage_max = 19;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(40, 50);
		$this->karma = -12500;
		$this->fame = 12500;
		$this->virtualarmor = 50;

}}
?>
