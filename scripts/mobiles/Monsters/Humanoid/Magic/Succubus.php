<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Succubus extends Mobile {
	public function summon() {
		$this->name = "a succubus";
		$this->body = 149;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x4B0;
		$this->str = rand(488, 620);
		$this->dex = rand(121, 170);
		$this->int = rand(498, 657);
		$this->maxhits = rand(312, 353);
		$this->hits = $this->maxhits;
		$this->damage = 18;
		$this->damageMax = 28;
		$this->resist_physical = rand(80, 90);
		$this->resist_fire = rand(70, 80);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(50, 60);
		$this->karma = -24000;
		$this->fame = 24000;
		$this->virtualarmor = 80;

}}
?>
