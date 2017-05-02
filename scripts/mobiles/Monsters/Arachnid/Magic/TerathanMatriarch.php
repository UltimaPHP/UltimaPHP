<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class TerathanMatriarch extends Mobile {
	public function summon() {
		$this->name = "a terathan matriarch";
		$this->body = 72;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(316, 405);
		$this->dex = rand(96, 115);
		$this->int = rand(366, 455);
		$this->maxhits = rand(190, 243);
		$this->hits = $this->maxhits;
		$this->damage = 11;
		$this->damageMax = 14;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(35, 45);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(35, 45);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 0;

}}
?>
