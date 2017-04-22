<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class airelemental extends Mobile {
	public function summon() {
		$this->name = "an air elemental";
		$this->body = 13;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(126, 155);
		$this->dex = rand(166, 185);
		$this->int = rand(101, 125);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 8;
		$this->damage_max = 10;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(25, 35);
		$this->karma = -4500;
		$this->fame = 4500;
		$this->virtualarmor = 40;

}}
?>
