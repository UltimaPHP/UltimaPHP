<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class grizzlybear extends Mobile {
	public function summon() {
		$this->name = "a grizzly bear";
		$this->body = 212;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xA3;
		$this->str = rand(126, 155);
		$this->dex = rand(81, 105);
		$this->int = rand(16, 40);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 8;
		$this->damage_max = 13;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = 0;
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 10);
		$this->karma = 0;
		$this->fame = 1000;
		$this->virtualarmor = 24;

}}
?>
