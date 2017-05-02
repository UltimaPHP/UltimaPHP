<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class OphidianMatriarch extends Mobile {
	public function summon() {
		$this->name = "an ophidian matriarch";
		$this->body = 87;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(416, 505);
		$this->dex = rand(96, 115);
		$this->int = rand(366, 455);
		$this->maxhits = rand(250, 303);
		$this->hits = $this->maxhits;
		$this->damage = 11;
		$this->damageMax = 13;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(35, 45);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(35, 45);
		$this->karma = -16000;
		$this->fame = 16000;
		$this->virtualarmor = 50;

}}
?>
