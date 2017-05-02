<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class PredatorHellCat extends Mobile {
	public function summon() {
		$this->name = "a hell cat";
		$this->body = 127;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xBA;
		$this->str = rand(161, 185);
		$this->dex = rand(96, 115);
		$this->int = rand(76, 100);
		$this->maxhits = rand(97, 131);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 17;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = rand(5, 15);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 30;

}}
?>
