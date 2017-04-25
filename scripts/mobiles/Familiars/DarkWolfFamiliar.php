<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class DarkWolfFamiliar extends Mobile {
	public function summon() {
		$this->name = "a dark wolf";
		$this->body = 99;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xE5;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->hits = 5;
		$this->maxhits = 10;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(25, 40);
		$this->resist_cold = rand(25, 40);
		$this->resist_poison = rand(25, 40);
		$this->resist_energy = rand(25, 40);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
