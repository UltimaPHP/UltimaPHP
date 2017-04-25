<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Troll extends Mobile {
	public function summon() {
		$this->name = "a troll";
		$this->body = Functions::RandomList(array(53, 54));
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(176, 205);
		$this->dex = rand(46, 65);
		$this->int = rand(46, 70);
		$this->hits = 8;
		$this->maxhits = 14;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(5, 15);
		$this->resist_energy = rand(5, 15);
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 40;

}}
?>
