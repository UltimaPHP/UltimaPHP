<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class greatermongbat extends Mobile {
	public function summon() {
		$this->name = "a greater mongbat";
		$this->body = 39;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(56, 80);
		$this->dex = rand(61, 80);
		$this->int = rand(26, 50);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 7;
		$this->resist_physical = rand(15, 25);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -450;
		$this->fame = 450;
		$this->virtualarmor = 10;

}}
?>
