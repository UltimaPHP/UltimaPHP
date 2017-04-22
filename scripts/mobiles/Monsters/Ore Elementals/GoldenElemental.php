<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class goldenelemental extends Mobile {
	public function summon() {
		$this->name = "a golden elemental";
		$this->body = 166;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(226, 255);
		$this->dex = rand(126, 145);
		$this->int = rand(71, 92);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 9;
		$this->damage_max = 16;
		$this->resist_physical = rand(60, 75);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 60;

}}
?>
