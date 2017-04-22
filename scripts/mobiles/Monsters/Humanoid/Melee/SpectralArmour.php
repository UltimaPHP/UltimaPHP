<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class spectralarmour extends Mobile {
	public function summon() {
		$this->name = "spectral armour";
		$this->body = 637;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(101, 110);
		$this->dex = rand(101, 110);
		$this->int = rand(101, 110);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 10;
		$this->damage_max = 22;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(20, 30);
		$this->karma = -7000;
		$this->fame = 7000;
		$this->virtualarmor = 40;

}}
?>
