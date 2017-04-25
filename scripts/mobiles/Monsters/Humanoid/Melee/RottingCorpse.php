<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class RottingCorpse extends Mobile {
	public function summon() {
		$this->name = "a rotting corpse";
		$this->body = 155;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(301, 350);
		$this->dex = 0;
		$this->int = rand(151, 200);
		$this->hits = 8;
		$this->maxhits = 10;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(50, 70);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(20, 30);
		$this->karma = -6000;
		$this->fame = 6000;
		$this->virtualarmor = 40;

}}
?>
