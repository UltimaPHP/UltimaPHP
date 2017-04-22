<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class darkguardian extends Mobile {
	public function summon() {
		$this->name = "a dark guardian";
		$this->body = 78;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x3E9;
		$this->str = rand(125, 150);
		$this->dex = rand(100, 120);
		$this->int = rand(200, 235);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 43;
		$this->damage_max = 48;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(20, 45);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(20, 45);
		$this->resist_energy = rand(30, 40);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 50;

}}
?>
