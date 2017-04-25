<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class MeerMage extends Mobile {
	public function summon() {
		$this->name = "a meer mage";
		$this->body = 770;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(171, 200);
		$this->dex = rand(126, 145);
		$this->int = rand(276, 305);
		$this->hits = 24;
		$this->maxhits = 26;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = 0;
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(25, 35);
		$this->karma = 8000;
		$this->fame = 8000;
		$this->virtualarmor = 16;

}}
?>
