<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Gargoyle extends Mobile {
	public function summon() {
		$this->name = "a gargoyle";
		$this->body = 4;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(146, 175);
		$this->dex = rand(76, 95);
		$this->int = rand(81, 105);
		$this->maxhits = rand(88, 105);
		$this->hits = $this->maxhits;
		$this->damage = 7;
		$this->damageMax = 14;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(5, 10);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = 0;
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 32;

}}
?>
