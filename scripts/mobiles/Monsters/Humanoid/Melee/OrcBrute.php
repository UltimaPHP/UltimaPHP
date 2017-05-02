<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class OrcBrute extends Mobile {
	public function summon() {
		$this->name = "an orc brute";
		$this->body = 189;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x45A;
		$this->str = rand(767, 945);
		$this->dex = rand(66, 75);
		$this->int = rand(46, 70);
		$this->maxhits = rand(476, 552);
		$this->hits = $this->maxhits;
		$this->damage = 20;
		$this->damageMax = 25;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(25, 35);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 50;

}}
?>
