<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class MeerEternal extends Mobile {
	public function summon() {
		$this->name = "a meer eternal";
		$this->body = 772;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(416, 505);
		$this->dex = rand(146, 165);
		$this->int = rand(566, 655);
		$this->maxhits = rand(250, 303);
		$this->hits = $this->maxhits;
		$this->damage = 11;
		$this->damageMax = 13;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(45, 55);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = 18000;
		$this->fame = 18000;
		$this->virtualarmor = 34;

}}
?>
