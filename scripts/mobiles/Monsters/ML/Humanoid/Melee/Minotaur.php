<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Minotaur extends Mobile {
	public function summon() {
		$this->name = "a minotaur";
		$this->body = 263;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(301, 340);
		$this->dex = rand(91, 110);
		$this->int = rand(31, 50);
		$this->maxhits = rand(301, 340);
		$this->hits = $this->maxhits;
		$this->damage = 11;
		$this->damageMax = 20;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 28;

}}
?>
