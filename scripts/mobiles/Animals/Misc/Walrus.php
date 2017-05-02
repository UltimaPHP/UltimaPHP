<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Walrus extends Mobile {
	public function summon() {
		$this->name = "a walrus";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xE0;
		$this->str = rand(21, 29);
		$this->dex = rand(46, 55);
		$this->int = rand(16, 20);
		$this->maxhits = rand(14, 17);
		$this->hits = $this->maxhits;
		$this->damage = 4;
		$this->damageMax = 10;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(20, 25);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 10);
		$this->karma = 0;
		$this->fame = 150;
		$this->virtualarmor = 18;

}}
?>
