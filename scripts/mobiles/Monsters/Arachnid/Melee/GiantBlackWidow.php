<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GiantBlackWidow extends Mobile {
	public function summon() {
		$this->name = "a giant black widow";
		$this->body = 0x9D;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x388;
		$this->str = rand(76, 100);
		$this->dex = rand(96, 115);
		$this->int = rand(36, 60);
		$this->maxhits = rand(46, 60);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 17;
		$this->resist_physical = rand(20, 30);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(10, 20);
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 24;

}}
?>
