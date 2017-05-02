<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class OrcCaptain extends Mobile {
	public function summon() {
		$this->name = "orc";
		$this->body = 7;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x45A;
		$this->str = rand(111, 145);
		$this->dex = rand(101, 135);
		$this->int = rand(86, 110);
		$this->maxhits = rand(67, 87);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 15;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 10);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 34;

}}
?>
