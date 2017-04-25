<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GazerLarva extends Mobile {
	public function summon() {
		$this->name = "a gazer larva";
		$this->body = 778;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(76, 100);
		$this->dex = rand(51, 75);
		$this->int = rand(56, 80);
		$this->hits = 2;
		$this->maxhits = 9;
		$this->resist_physical = rand(15, 25);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -900;
		$this->fame = 900;
		$this->virtualarmor = 25;

}}
?>
