<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class snake extends Mobile {
	public function summon() {
		$this->name = "a snake";
		$this->body = 52;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xDB;
		$this->str = rand(22, 34);
		$this->dex = rand(16, 25);
		$this->int = rand(6, 10);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 1;
		$this->damage_max = 4;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = 0;
		$this->karma = -300;
		$this->fame = 300;
		$this->virtualarmor = 16;

}}
?>
