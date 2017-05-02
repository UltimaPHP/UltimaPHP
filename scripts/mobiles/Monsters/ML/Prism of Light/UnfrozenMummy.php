<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class UnfrozenMummy extends Mobile {
	public function summon() {
		$this->name = "an unfrozen mummy";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x1D7;
		$this->str = rand(450, 500);
		$this->dex = rand(200, 250);
		$this->int = rand(800, 850);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 16;
		$this->damageMax = 20;
		$this->resist_physical = rand(35, 40);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(60, 80);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(70, 80);
		$this->karma = -25000;
		$this->fame = 25000;
		$this->virtualarmor = 0;

}}
?>
