<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class tangle extends Mobile {
	public function summon() {
		$this->name = "tangle";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x16A;
		$this->str = rand(870, 940);
		$this->dex = rand(58, 74);
		$this->int = rand(46, 58);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 15;
		$this->damage_max = 28;
		$this->resist_physical = rand(50, 57);
		$this->resist_fire = rand(40, 43);
		$this->resist_cold = rand(30, 35);
		$this->resist_poison = rand(61, 69);
		$this->resist_energy = rand(41, 45);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
