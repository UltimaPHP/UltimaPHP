<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Cursed extends Mobile {
	public function summon() {
		$this->name = "male";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(91, 100);
		$this->dex = rand(86, 95);
		$this->int = rand(61, 70);
		$this->maxhits = rand(91, 120);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 13;
		$this->resist_physical = rand(15, 25);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 10);
		$this->karma = -2000;
		$this->fame = 1000;
		$this->virtualarmor = 0;

}}
?>
