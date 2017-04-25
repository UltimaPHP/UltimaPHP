<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class AntLion extends Mobile {
	public function summon() {
		$this->name = "an ant lion";
		$this->body = 787;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(296, 320);
		$this->dex = rand(81, 105);
		$this->int = rand(36, 60);
		$this->hits = 7;
		$this->maxhits = 21;
		$this->resist_physical = rand(45, 60);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(30, 35);
		$this->karma = -4500;
		$this->fame = 4500;
		$this->virtualarmor = 45;

}}
?>
