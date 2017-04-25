<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ChaosDragoonElite extends Mobile {
	public function summon() {
		$this->name = "a chaos dragoon elite";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(276, 350);
		$this->dex = rand(66, 90);
		$this->int = rand(126, 150);
		$this->hits = 29;
		$this->maxhits = 34;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = 0;
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(25, 35);
		$this->karma = -8000;
		$this->fame = 8000;
		$this->virtualarmor = 0;

}}
?>
