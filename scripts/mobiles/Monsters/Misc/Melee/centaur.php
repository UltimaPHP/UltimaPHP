<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class centaur extends Mobile {
	public function summon() {
		$this->name = "centaur";
		$this->body = 51;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xDB;
		$this->str = rand(22, 34);
		$this->dex = rand(16, 21);
		$this->int = rand(16, 20);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 1;
		$this->damage_max = 5;
		$this->resist_physical = rand(5, 10);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = rand(60, 70);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(60, 70);
		$this->karma = -300;
		$this->fame = 300;
		$this->virtualarmor = 8;

}}
?>
