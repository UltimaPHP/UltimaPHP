<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class grobu extends Mobile {
	public function summon() {
		$this->name = "grobu";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(192, 210);
		$this->dex = rand(132, 150);
		$this->int = rand(50, 52);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 15;
		$this->damage_max = 18;
		$this->resist_physical = rand(40, 45);
		$this->resist_fire = rand(20, 40);
		$this->resist_cold = rand(32, 35);
		$this->resist_poison = rand(25, 30);
		$this->resist_energy = rand(22, 34);
		$this->karma = 1000;
		$this->fame = 1000;
		$this->virtualarmor = 0;

}}
?>
