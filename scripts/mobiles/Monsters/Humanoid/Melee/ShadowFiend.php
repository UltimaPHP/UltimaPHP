<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ShadowFiend extends Mobile {
	public function summon() {
		$this->name = "a shadow fiend";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(46, 55);
		$this->dex = rand(121, 130);
		$this->int = rand(46, 55);
		$this->hits = 10;
		$this->maxhits = 22;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(20, 25);
		$this->resist_cold = rand(40, 45);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(5, 10);
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 0;

}}
?>
