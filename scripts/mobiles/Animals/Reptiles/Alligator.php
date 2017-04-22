<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class alligator extends Mobile {
	public function summon() {
		$this->name = "an alligator";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x5A;
		$this->str = rand(76, 100);
		$this->dex = rand(6, 25);
		$this->int = rand(11, 20);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 15;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = 0;
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = 0;
		$this->karma = -600;
		$this->fame = 600;
		$this->virtualarmor = 30;

}}
?>
