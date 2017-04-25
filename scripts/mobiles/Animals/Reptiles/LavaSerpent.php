<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class LavaSerpent extends Mobile {
	public function summon() {
		$this->name = "a lava serpent";
		$this->body = 90;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(386, 415);
		$this->dex = rand(56, 80);
		$this->int = rand(66, 85);
		$this->hits = 10;
		$this->maxhits = 22;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(70, 80);
		$this->resist_cold = 0;
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(10, 20);
		$this->karma = -4500;
		$this->fame = 4500;
		$this->virtualarmor = 40;

}}
?>
