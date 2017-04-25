<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Protector extends Mobile {
	public function summon() {
		$this->name = "a protector";
		$this->body = 401;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(700, 800);
		$this->dex = rand(100, 150);
		$this->int = rand(50, 75);
		$this->hits = 6;
		$this->maxhits = 12;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(35, 40);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 0;

}}
?>
