<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class KazeKemono extends Mobile {
	public function summon() {
		$this->name = "a kaze kemono";
		$this->body = 196;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(201, 275);
		$this->dex = rand(101, 155);
		$this->int = rand(101, 105);
		$this->hits = 15;
		$this->maxhits = 20;
		$this->resist_physical = rand(50, 70);
		$this->resist_fire = rand(30, 60);
		$this->resist_cold = rand(30, 60);
		$this->resist_poison = rand(50, 70);
		$this->resist_energy = rand(60, 80);
		$this->karma = -8000;
		$this->fame = 8000;
		$this->virtualarmor = 0;

}}
?>
