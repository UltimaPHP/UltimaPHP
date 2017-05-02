<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BlackBear extends Mobile {
	public function summon() {
		$this->name = "a black bear";
		$this->body = 211;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xA3;
		$this->str = rand(76, 100);
		$this->dex = rand(56, 75);
		$this->int = rand(11, 14);
		$this->maxhits = rand(46, 60);
		$this->hits = $this->maxhits;
		$this->damage = 4;
		$this->damageMax = 10;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = 0;
		$this->resist_cold = rand(10, 15);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = 0;
		$this->karma = 0;
		$this->fame = 450;
		$this->virtualarmor = 24;

}}
?>
