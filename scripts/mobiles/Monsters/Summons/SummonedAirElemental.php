<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class summonedairelemental extends Mobile {
	public function summon() {
		$this->name = "an air elemental";
		$this->body = 13;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 6;
		$this->damage_max = 9;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(35, 45);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(70, 80);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 40;

}}
?>
