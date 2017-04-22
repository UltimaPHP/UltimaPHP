<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class polarbear extends Mobile {
	public function summon() {
		$this->name = "a polar bear";
		$this->body = 213;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xA3;
		$this->str = rand(116, 140);
		$this->dex = rand(81, 105);
		$this->int = rand(26, 50);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 7;
		$this->damage_max = 12;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = 0;
		$this->resist_cold = rand(60, 80);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(10, 15);
		$this->karma = 0;
		$this->fame = 1500;
		$this->virtualarmor = 18;

}}
?>
