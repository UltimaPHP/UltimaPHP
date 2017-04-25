<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class LavaLizard extends Mobile {
	public function summon() {
		$this->name = "a lava lizard";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x5A;
		$this->str = rand(126, 150);
		$this->dex = rand(56, 75);
		$this->int = rand(11, 20);
		$this->hits = 6;
		$this->maxhits = 24;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(30, 45);
		$this->resist_cold = 0;
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(25, 35);
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 40;

}}
?>
