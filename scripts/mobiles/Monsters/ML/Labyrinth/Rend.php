<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class rend extends Mobile {
	public function summon() {
		$this->name = "rend";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(1261, 1284);
		$this->dex = rand(363, 384);
		$this->int = rand(601, 642);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 26;
		$this->damage_max = 33;
		$this->resist_physical = rand(75, 85);
		$this->resist_fire = rand(81, 94);
		$this->resist_cold = rand(46, 55);
		$this->resist_poison = rand(35, 44);
		$this->resist_energy = rand(45, 52);
		$this->karma = -21000;
		$this->fame = 21000;
		$this->virtualarmor = 0;

}}
?>
