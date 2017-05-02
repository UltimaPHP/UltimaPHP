<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class MountainGoat extends Mobile {
	public function summon() {
		$this->name = "a mountain goat";
		$this->body = 88;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x99;
		$this->str = rand(22, 64);
		$this->dex = rand(56, 75);
		$this->int = rand(16, 30);
		$this->maxhits = rand(20, 33);
		$this->hits = $this->maxhits;
		$this->damage = 3;
		$this->damageMax = 7;
		$this->resist_physical = rand(10, 20);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(10, 15);
		$this->resist_energy = rand(10, 15);
		$this->karma = 0;
		$this->fame = 300;
		$this->virtualarmor = 10;

}}
?>
