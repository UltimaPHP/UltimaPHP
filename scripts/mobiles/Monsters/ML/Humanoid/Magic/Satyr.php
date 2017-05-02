<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Satyr extends Mobile {
	public function summon() {
		$this->name = "a satyr";
		$this->body = 271;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x586;
		$this->str = rand(177, 195);
		$this->dex = rand(251, 269);
		$this->int = rand(153, 170);
		$this->maxhits = rand(350, 400);
		$this->hits = $this->maxhits;
		$this->damage = 13;
		$this->damageMax = 24;
		$this->resist_physical = rand(55, 60);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = 0;
		$this->fame = 5000;
		$this->virtualarmor = 28;

}}
?>
