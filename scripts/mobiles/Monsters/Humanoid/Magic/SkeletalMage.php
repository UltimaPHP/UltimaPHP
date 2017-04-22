<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class skeletalmage extends Mobile {
	public function summon() {
		$this->name = "a skeletal mage";
		$this->body = 148;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(76, 100);
		$this->dex = rand(56, 75);
		$this->int = rand(186, 210);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 3;
		$this->damage_max = 7;
		$this->resist_physical = rand(35, 40);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(30, 40);
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 38;

}}
?>
