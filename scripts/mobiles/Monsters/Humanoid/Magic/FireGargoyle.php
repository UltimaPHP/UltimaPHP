<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class FireGargoyle extends Mobile {
	public function summon() {
		$this->name = "fire gargoyle";
		$this->body = 130;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x174;
		$this->str = rand(351, 400);
		$this->dex = rand(126, 145);
		$this->int = rand(226, 250);
		$this->hits = 7;
		$this->maxhits = 14;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = 0;
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(20, 30);
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 32;

}}
?>
