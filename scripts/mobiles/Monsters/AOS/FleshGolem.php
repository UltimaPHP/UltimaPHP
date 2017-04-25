<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class FleshGolem extends Mobile {
	public function summon() {
		$this->name = "a flesh golem";
		$this->body = 304;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(176, 200);
		$this->dex = rand(51, 75);
		$this->int = rand(46, 70);
		$this->hits = 18;
		$this->maxhits = 22;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(30, 40);
		$this->karma = -1800;
		$this->fame = 1000;
		$this->virtualarmor = 34;

}}
?>
