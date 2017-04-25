<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class EliteNinja extends Mobile {
	public function summon() {
		$this->name = "an elite ninja";
		$this->body = 0x191;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(126, 225);
		$this->dex = rand(81, 95);
		$this->int = rand(151, 165);
		$this->hits = 12;
		$this->maxhits = 20;
		$this->resist_physical = rand(35, 65);
		$this->resist_fire = rand(40, 60);
		$this->resist_cold = rand(25, 45);
		$this->resist_poison = rand(40, 60);
		$this->resist_energy = rand(35, 55);
		$this->karma = -8500;
		$this->fame = 8500;
		$this->virtualarmor = 0;

}}
?>
