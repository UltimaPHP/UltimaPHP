<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class abandonescortentry extends Mobile {
	public function summon() {
		$this->name = "male";
		$this->body = 400;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(90, 100);
		$this->dex = rand(90, 100);
		$this->int = rand(15, 25);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 0;
		$this->damage_max = 0;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = 4000;
		$this->fame = 200;
		$this->virtualarmor = 0;

}}
?>
