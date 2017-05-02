<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class MinotaurScout extends Mobile {
	public function summon() {
		$this->name = "a minotaur scout";
		$this->body = 281;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(353, 375);
		$this->dex = rand(111, 130);
		$this->int = rand(34, 50);
		$this->maxhits = rand(354, 383);
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
