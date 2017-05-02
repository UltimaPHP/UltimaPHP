<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SilverSerpent extends Mobile {
	public function summon() {
		$this->name = "a silver serpent";
		$this->body = 92;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(161, 360);
		$this->dex = rand(151, 300);
		$this->int = rand(21, 40);
		$this->maxhits = rand(97, 216);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 21;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(5, 10);
		$this->resist_poison = 0;
		$this->resist_energy = rand(5, 10);
		$this->karma = -7000;
		$this->fame = 7000;
		$this->virtualarmor = 40;

}}
?>
