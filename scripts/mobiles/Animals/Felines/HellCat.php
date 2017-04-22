<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class hellcat extends Mobile {
	public function summon() {
		$this->name = "a hell cat";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x69;
		$this->str = rand(51, 100);
		$this->dex = rand(52, 150);
		$this->int = rand(13, 85);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 6;
		$this->damage_max = 12;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(80, 90);
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = rand(15, 20);
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 30;

}}
?>
