<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class PlagueSpawn extends Mobile {
	public function summon() {
		$this->name = "a plague spawn";
		$this->body = 51;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xDB;
		$this->str = rand(201, 300);
		$this->dex = 0;
		$this->int = rand(16, 20);
		$this->hits = 11;
		$this->maxhits = 17;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(65, 75);
		$this->resist_energy = rand(25, 35);
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 20;

}}
?>
