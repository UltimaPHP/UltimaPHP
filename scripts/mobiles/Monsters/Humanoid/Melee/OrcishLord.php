<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class OrcishLord extends Mobile {
	public function summon() {
		$this->name = "an orcish lord";
		$this->body = 138;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x45A;
		$this->str = rand(147, 215);
		$this->dex = rand(91, 115);
		$this->int = rand(61, 85);
		$this->hits = 4;
		$this->maxhits = 14;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 0;

}}
?>
