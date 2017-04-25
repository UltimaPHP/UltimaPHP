<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Kappa extends Mobile {
	public function summon() {
		$this->name = "a kappa";
		$this->body = 240;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(186, 230);
		$this->dex = rand(51, 75);
		$this->int = rand(41, 55);
		$this->hits = 6;
		$this->maxhits = 12;
		$this->resist_physical = rand(35, 50);
		$this->resist_fire = rand(35, 50);
		$this->resist_cold = rand(25, 50);
		$this->resist_poison = rand(35, 50);
		$this->resist_energy = rand(20, 30);
		$this->karma = -1700;
		$this->fame = 1700;
		$this->virtualarmor = 0;

}}
?>
