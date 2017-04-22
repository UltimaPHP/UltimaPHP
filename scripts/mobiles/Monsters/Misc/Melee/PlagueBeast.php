<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class plaguebeast extends Mobile {
	public function summon() {
		$this->name = "a plague beast";
		$this->body = 775;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(302, 500);
		$this->dex = 0;
		$this->int = rand(16, 20);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 20;
		$this->damage_max = 24;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(65, 75);
		$this->resist_energy = rand(25, 35);
		$this->karma = -13000;
		$this->fame = 13000;
		$this->virtualarmor = 30;

}}
?>
