<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GiantRat extends Mobile {
	public function summon() {
		$this->name = "a giant rat";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x188;
		$this->str = rand(32, 74);
		$this->dex = rand(46, 65);
		$this->int = rand(16, 30);
		$this->hits = 4;
		$this->maxhits = 8;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = 0;
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = 0;
		$this->karma = -300;
		$this->fame = 300;
		$this->virtualarmor = 18;

}}
?>
