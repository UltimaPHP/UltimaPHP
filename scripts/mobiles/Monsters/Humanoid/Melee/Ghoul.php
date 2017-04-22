<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ghoul extends Mobile {
	public function summon() {
		$this->name = "a ghoul";
		$this->body = 153;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x482;
		$this->str = rand(76, 100);
		$this->dex = rand(76, 95);
		$this->int = rand(36, 60);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 7;
		$this->damage_max = 9;
		$this->resist_physical = rand(25, 30);
		$this->resist_fire = 0;
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(10, 20);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 28;

}}
?>
