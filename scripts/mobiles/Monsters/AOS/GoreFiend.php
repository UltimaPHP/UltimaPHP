<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GoreFiend extends Mobile {
	public function summon() {
		$this->name = "a gore fiend";
		$this->body = 305;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(161, 185);
		$this->dex = rand(41, 65);
		$this->int = rand(46, 70);
		$this->hits = 15;
		$this->maxhits = 21;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(5, 15);
		$this->resist_energy = rand(30, 40);
		$this->karma = -1500;
		$this->fame = 1500;
		$this->virtualarmor = 24;

}}
?>
