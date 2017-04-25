<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WaterElemental extends Mobile {
	public function summon() {
		$this->name = "a water elemental";
		$this->body = 16;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(126, 155);
		$this->dex = rand(66, 85);
		$this->int = rand(101, 125);
		$this->hits = 7;
		$this->maxhits = 9;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(10, 25);
		$this->resist_cold = rand(10, 25);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(5, 10);
		$this->karma = -4500;
		$this->fame = 4500;
		$this->virtualarmor = 40;

}}
?>
