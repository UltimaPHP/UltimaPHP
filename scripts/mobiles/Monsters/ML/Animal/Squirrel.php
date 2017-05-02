<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Squirrel extends Mobile {
	public function summon() {
		$this->name = "a squirrel";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(44, 50);
		$this->dex = 0;
		$this->int = 0;
		$this->maxhits = rand(42, 50);
		$this->hits = $this->maxhits;
		$this->damage = 1;
		$this->damageMax = 2;
		$this->resist_physical = rand(30, 34);
		$this->resist_fire = rand(10, 14);
		$this->resist_cold = rand(30, 35);
		$this->resist_poison = rand(20, 25);
		$this->resist_energy = rand(20, 25);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
