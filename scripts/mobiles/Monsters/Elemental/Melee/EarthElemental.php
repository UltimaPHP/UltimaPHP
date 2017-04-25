<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class EarthElemental extends Mobile {
	public function summon() {
		$this->name = "an earth elemental";
		$this->body = 14;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(126, 155);
		$this->dex = rand(66, 85);
		$this->int = rand(71, 92);
		$this->hits = 9;
		$this->maxhits = 16;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = rand(10, 20);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(15, 25);
		$this->karma = -3500;
		$this->fame = 3500;
		$this->virtualarmor = 34;

}}
?>
