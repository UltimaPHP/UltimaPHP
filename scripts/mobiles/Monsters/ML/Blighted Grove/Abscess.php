<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class abscess extends Mobile {
	public function summon() {
		$this->name = "abscess";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(845, 871);
		$this->dex = rand(121, 134);
		$this->int = rand(124, 142);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 26;
		$this->damage_max = 31;
		$this->resist_physical = rand(65, 75);
		$this->resist_fire = rand(70, 80);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(35, 45);
		$this->resist_energy = rand(35, 45);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
