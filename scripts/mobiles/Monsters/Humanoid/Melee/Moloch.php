<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class moloch extends Mobile {
	public function summon() {
		$this->name = "a moloch";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x300;
		$this->str = rand(331, 360);
		$this->dex = rand(66, 85);
		$this->int = rand(41, 65);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 15;
		$this->damage_max = 23;
		$this->resist_physical = rand(60, 70);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(20, 30);
		$this->karma = -7500;
		$this->fame = 7500;
		$this->virtualarmor = 32;

}}
?>
