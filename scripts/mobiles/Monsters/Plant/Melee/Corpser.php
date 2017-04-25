<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Corpser extends Mobile {
	public function summon() {
		$this->name = "a corpser";
		$this->body = 8;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(156, 180);
		$this->dex = rand(26, 45);
		$this->int = rand(26, 40);
		$this->hits = 10;
		$this->maxhits = 23;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = 0;
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 18;

}}
?>
