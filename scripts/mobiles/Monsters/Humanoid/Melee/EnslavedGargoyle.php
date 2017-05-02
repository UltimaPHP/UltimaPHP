<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class EnslavedGargoyle extends Mobile {
	public function summon() {
		$this->name = "an enslaved gargoyle";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x174;
		$this->str = rand(302, 360);
		$this->dex = rand(76, 95);
		$this->int = rand(81, 105);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 7;
		$this->damageMax = 14;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(50, 70);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(25, 30);
		$this->resist_energy = rand(25, 30);
		$this->karma = 0;
		$this->fame = 3500;
		$this->virtualarmor = 35;

}}
?>
