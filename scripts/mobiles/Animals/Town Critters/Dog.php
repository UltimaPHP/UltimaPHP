<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class dog extends Mobile {
	public function summon() {
		$this->name = "a dog";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x85;
		$this->str = rand(27, 37);
		$this->dex = rand(28, 43);
		$this->int = rand(29, 37);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 4;
		$this->damage_max = 7;
		$this->resist_physical = rand(10, 15);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = 300;
		$this->fame = 0;
		$this->virtualarmor = 12;

}}
?>
