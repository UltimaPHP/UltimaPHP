<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class shadowwyrm extends Mobile {
	public function summon() {
		$this->name = "a shadow wyrm";
		$this->body = 106;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(898, 1030);
		$this->dex = rand(68, 200);
		$this->int = rand(488, 620);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 29;
		$this->damage_max = 35;
		$this->resist_physical = rand(65, 75);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(45, 55);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(50, 60);
		$this->karma = -22500;
		$this->fame = 22500;
		$this->virtualarmor = 70;

}}
?>
