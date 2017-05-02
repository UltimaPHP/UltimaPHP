<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class FerelTreefellow extends Mobile {
	public function summon() {
		$this->name = "a ferel treefellow";
		$this->body = 301;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(1351, 1600);
		$this->dex = rand(301, 550);
		$this->int = rand(651, 900);
		$this->maxhits = rand(1170, 1320);
		$this->hits = $this->maxhits;
		$this->damage = 26;
		$this->damageMax = 35;
		$this->resist_physical = rand(60, 70);
		$this->resist_fire = 0;
		$this->resist_cold = rand(70, 80);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(40, 60);
		$this->karma = 12500;
		$this->fame = 12500;
		$this->virtualarmor = 24;

}}
?>
