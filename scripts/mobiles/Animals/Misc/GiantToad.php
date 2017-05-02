<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GiantToad extends Mobile {
	public function summon() {
		$this->name = "a giant toad";
		$this->body = 80;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x26B;
		$this->str = rand(76, 100);
		$this->dex = rand(6, 25);
		$this->int = rand(11, 20);
		$this->maxhits = rand(46, 60);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 17;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = rand(5, 10);
		$this->karma = -750;
		$this->fame = 750;
		$this->virtualarmor = 24;

}}
?>
