<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class putrefier extends Mobile {
	public function summon() {
		$this->name = "putrefier";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(1057, 1400);
		$this->dex = rand(232, 560);
		$this->int = rand(201, 440);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 27;
		$this->damage_max = 34;
		$this->resist_physical = rand(65, 80);
		$this->resist_fire = rand(65, 80);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = 0;
		$this->resist_energy = rand(40, 50);
		$this->karma = -24000;
		$this->fame = 24000;
		$this->virtualarmor = 0;

}}
?>
