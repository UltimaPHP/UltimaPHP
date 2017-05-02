<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Dolphin extends Mobile {
	public function summon() {
		$this->name = "a dolphin";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x8A;
		$this->str = rand(21, 49);
		$this->dex = rand(66, 85);
		$this->int = rand(96, 110);
		$this->maxhits = rand(15, 27);
		$this->hits = $this->maxhits;
		$this->damage = 3;
		$this->damageMax = 6;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(70, 80);
		$this->resist_cold = rand(25, 30);
		$this->resist_poison = rand(10, 15);
		$this->resist_energy = rand(10, 15);
		$this->karma = 2000;
		$this->fame = 500;
		$this->virtualarmor = 16;

}}
?>
