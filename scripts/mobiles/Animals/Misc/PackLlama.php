<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class PackLlama extends Mobile {
	public function summon() {
		$this->name = "a pack llama";
		$this->body = 292;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x3F3;
		$this->str = rand(52, 80);
		$this->dex = rand(36, 55);
		$this->int = rand(16, 30);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 2;
		$this->damageMax = 6;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(10, 15);
		$this->resist_cold = rand(10, 15);
		$this->resist_poison = rand(10, 15);
		$this->resist_energy = rand(10, 15);
		$this->karma = 200;
		$this->fame = 0;
		$this->virtualarmor = 16;

}}
?>
