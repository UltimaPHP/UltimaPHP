<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Eagle extends Mobile {
	public function summon() {
		$this->name = "an eagle";
		$this->body = 5;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x2EE;
		$this->str = rand(31, 47);
		$this->dex = rand(36, 60);
		$this->int = rand(8, 20);
		$this->maxhits = rand(20, 27);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 10;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(10, 15);
		$this->resist_cold = rand(20, 25);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 10);
		$this->karma = 0;
		$this->fame = 300;
		$this->virtualarmor = 22;

}}
?>
