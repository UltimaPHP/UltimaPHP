<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class CrystalVortex extends Mobile {
	public function summon() {
		$this->name = "a crystal vortex";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x107;
		$this->str = rand(800, 900);
		$this->dex = rand(500, 600);
		$this->int = 0;
		$this->hits = 15;
		$this->maxhits = 20;
		$this->resist_physical = rand(60, 80);
		$this->resist_fire = rand(0, 10);
		$this->resist_cold = rand(70, 80);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(60, 90);
		$this->karma = -17000;
		$this->fame = 17000;
		$this->virtualarmor = 0;

}}
?>
