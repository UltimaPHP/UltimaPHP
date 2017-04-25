<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Quagmire extends Mobile {
	public function summon() {
		$this->name = "a quagmire";
		$this->body = 789;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(101, 130);
		$this->dex = rand(66, 85);
		$this->int = rand(31, 55);
		$this->hits = 10;
		$this->maxhits = 14;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = 0;
		$this->resist_energy = rand(20, 30);
		$this->karma = -1500;
		$this->fame = 1500;
		$this->virtualarmor = 32;

}}
?>
