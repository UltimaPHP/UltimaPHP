<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BlackSolenQueen extends Mobile {
	public function summon() {
		$this->name = "a black solen queen";
		$this->body = 807;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(296, 320);
		$this->dex = rand(121, 145);
		$this->int = rand(76, 100);
		$this->hits = 10;
		$this->maxhits = 15;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(30, 35);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(35, 40);
		$this->resist_energy = rand(25, 30);
		$this->karma = -4500;
		$this->fame = 4500;
		$this->virtualarmor = 45;

}}
?>
