<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class TerathanWarrior extends Mobile {
	public function summon() {
		$this->name = "a terathan warrior";
		$this->body = 70;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(166, 215);
		$this->dex = rand(96, 145);
		$this->int = rand(41, 65);
		$this->maxhits = rand(100, 129);
		$this->hits = $this->maxhits;
		$this->damage = 7;
		$this->damageMax = 17;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(25, 35);
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 30;

}}
?>
