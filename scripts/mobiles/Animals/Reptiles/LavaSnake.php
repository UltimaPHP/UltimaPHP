<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class LavaSnake extends Mobile {
	public function summon() {
		$this->name = "a lava snake";
		$this->body = 52;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xDB;
		$this->str = rand(43, 55);
		$this->dex = rand(16, 25);
		$this->int = rand(6, 10);
		$this->hits = 1;
		$this->maxhits = 8;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = 0;
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(10, 20);
		$this->karma = -600;
		$this->fame = 600;
		$this->virtualarmor = 24;

}}
?>
