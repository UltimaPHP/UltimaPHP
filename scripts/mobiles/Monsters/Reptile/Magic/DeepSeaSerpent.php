<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class deepseaserpent extends Mobile {
	public function summon() {
		$this->name = "a deep sea serpent";
		$this->body = 150;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(251, 425);
		$this->dex = rand(87, 135);
		$this->int = rand(87, 155);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 6;
		$this->damage_max = 14;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(70, 80);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(15, 20);
		$this->karma = -6000;
		$this->fame = 6000;
		$this->virtualarmor = 60;

}}
?>
