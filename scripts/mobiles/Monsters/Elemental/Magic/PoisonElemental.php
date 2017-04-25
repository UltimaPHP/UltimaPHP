<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class PoisonElemental extends Mobile {
	public function summon() {
		$this->name = "a poison elemental";
		$this->body = 162;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(426, 515);
		$this->dex = rand(166, 185);
		$this->int = rand(361, 435);
		$this->hits = 12;
		$this->maxhits = 18;
		$this->resist_physical = rand(60, 70);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = 0;
		$this->resist_energy = rand(40, 50);
		$this->karma = -12500;
		$this->fame = 12500;
		$this->virtualarmor = 70;

}}
?>
