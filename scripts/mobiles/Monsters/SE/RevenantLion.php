<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class RevenantLion extends Mobile {
	public function summon() {
		$this->name = "a revenant lion";
		$this->body = 251;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(276, 325);
		$this->dex = rand(156, 175);
		$this->int = rand(76, 105);
		$this->hits = 18;
		$this->maxhits = 24;
		$this->resist_physical = rand(40, 60);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(55, 65);
		$this->resist_energy = rand(40, 50);
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 0;

}}
?>
