<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Imp extends Mobile {
	public function summon() {
		$this->name = "an imp";
		$this->body = 74;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(91, 115);
		$this->dex = rand(61, 80);
		$this->int = rand(86, 105);
		$this->maxhits = rand(55, 70);
		$this->hits = $this->maxhits;
		$this->damage = 10;
		$this->damageMax = 14;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 30;

}}
?>
