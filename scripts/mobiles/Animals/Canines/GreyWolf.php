<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GreyWolf extends Mobile {
	public function summon() {
		$this->name = "a grey wolf";
		$this->body = Functions::RandomList(array(25, 27));
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xE5;
		$this->str = rand(56, 80);
		$this->dex = rand(56, 75);
		$this->int = rand(31, 55);
		$this->hits = 3;
		$this->maxhits = 7;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(10, 15);
		$this->resist_cold = rand(20, 25);
		$this->resist_poison = rand(10, 15);
		$this->resist_energy = rand(10, 15);
		$this->karma = 0;
		$this->fame = 450;
		$this->virtualarmor = 16;

}}
?>
