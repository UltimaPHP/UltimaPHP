<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class swamptentacle extends Mobile {
	public function summon() {
		$this->name = "a swamp tentacle";
		$this->body = 66;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(96, 120);
		$this->dex = rand(66, 85);
		$this->int = rand(16, 30);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 6;
		$this->damage_max = 12;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(60, 80);
		$this->resist_energy = rand(10, 20);
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 28;

}}
?>
