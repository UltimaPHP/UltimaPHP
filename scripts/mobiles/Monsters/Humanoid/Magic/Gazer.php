<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class gazer extends Mobile {
	public function summon() {
		$this->name = "a gazer";
		$this->body = 22;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(96, 125);
		$this->dex = rand(86, 105);
		$this->int = rand(141, 165);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 10;
		$this->resist_physical = rand(35, 40);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(20, 30);
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 36;

}}
?>
