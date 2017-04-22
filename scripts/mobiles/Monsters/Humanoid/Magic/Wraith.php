<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class wraith extends Mobile {
	public function summon() {
		$this->name = "a wraith";
		$this->body = 26;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x482;
		$this->str = rand(76, 100);
		$this->dex = rand(76, 95);
		$this->int = rand(36, 60);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 7;
		$this->damage_max = 11;
		$this->resist_physical = rand(25, 30);
		$this->resist_fire = 0;
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = 0;
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 28;

}}
?>
