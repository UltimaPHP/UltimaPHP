<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Ettin extends Mobile {
	public function summon() {
		$this->name = "an ettin";
		$this->body = 18;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(136, 165);
		$this->dex = rand(56, 75);
		$this->int = rand(31, 55);
		$this->maxhits = rand(82, 99);
		$this->hits = $this->maxhits;
		$this->damage = 7;
		$this->damageMax = 17;
		$this->resist_physical = rand(35, 40);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(15, 25);
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 38;

}}
?>
