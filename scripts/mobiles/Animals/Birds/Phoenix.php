<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Phoenix extends Mobile {
	public function summon() {
		$this->name = "a phoenix";
		$this->body = 5;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x8F;
		$this->str = rand(504, 700);
		$this->dex = rand(202, 300);
		$this->int = rand(504, 700);
		$this->maxhits = rand(340, 383);
		$this->hits = $this->maxhits;
		$this->damage = 0;
		$this->damageMax = 0;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = 0;
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(40, 50);
		$this->karma = 0;
		$this->fame = 15000;
		$this->virtualarmor = 60;

}}
?>
