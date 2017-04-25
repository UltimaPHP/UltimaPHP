<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class LichLord extends Mobile {
	public function summon() {
		$this->name = "a lich lord";
		$this->body = 79;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(416, 505);
		$this->dex = rand(146, 165);
		$this->int = rand(566, 655);
		$this->hits = 11;
		$this->maxhits = 13;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(40, 50);
		$this->karma = -18000;
		$this->fame = 18000;
		$this->virtualarmor = 50;

}}
?>
