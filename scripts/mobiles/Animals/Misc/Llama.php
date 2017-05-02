<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Llama extends Mobile {
	public function summon() {
		$this->name = "a llama";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x3F3;
		$this->str = rand(21, 49);
		$this->dex = rand(36, 55);
		$this->int = rand(16, 30);
		$this->maxhits = rand(15, 27);
		$this->hits = $this->maxhits;
		$this->damage = 3;
		$this->damageMax = 5;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = 0;
		$this->fame = 300;
		$this->virtualarmor = 16;

}}
?>
