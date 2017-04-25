<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SummonedFireElemental extends Mobile {
	public function summon() {
		$this->name = "a fire elemental";
		$this->body = 15;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->hits = 9;
		$this->maxhits = 14;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(70, 80);
		$this->resist_cold = rand(0, 10);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(50, 60);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 40;

}}
?>
