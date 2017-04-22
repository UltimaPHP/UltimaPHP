<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ancientwyrm extends Mobile {
	public function summon() {
		$this->name = "an ancient wyrm";
		$this->body = 46;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(1096, 1185);
		$this->dex = rand(86, 175);
		$this->int = rand(686, 775);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 29;
		$this->damage_max = 35;
		$this->resist_physical = rand(65, 75);
		$this->resist_fire = rand(80, 90);
		$this->resist_cold = rand(70, 80);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(60, 70);
		$this->karma = -22500;
		$this->fame = 22500;
		$this->virtualarmor = 70;

}}
?>
