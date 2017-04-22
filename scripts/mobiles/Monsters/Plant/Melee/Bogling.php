<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class bogling extends Mobile {
	public function summon() {
		$this->name = "a bogling";
		$this->body = 779;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(96, 120);
		$this->dex = rand(91, 115);
		$this->int = rand(21, 45);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 7;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(15, 25);
		$this->karma = -450;
		$this->fame = 450;
		$this->virtualarmor = 28;

}}
?>
