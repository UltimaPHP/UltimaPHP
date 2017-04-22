<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class jukamage extends Mobile {
	public function summon() {
		$this->name = "a juka mage";
		$this->body = 765;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(201, 300);
		$this->dex = rand(71, 90);
		$this->int = rand(451, 500);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 4;
		$this->damage_max = 10;
		$this->resist_physical = rand(20, 30);
		$this->resist_fire = rand(35, 45);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(35, 45);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 16;

}}
?>
