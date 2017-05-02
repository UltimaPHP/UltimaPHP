<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class PackAnimalBackpackEntry extends Mobile {
	public function summon() {
		$this->name = "a pack horse";
		$this->body = 291;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xA8;
		$this->str = rand(44, 120);
		$this->dex = rand(36, 55);
		$this->int = rand(6, 10);
		$this->maxhits = rand(61, 80);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 11;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(10, 15);
		$this->resist_cold = rand(20, 25);
		$this->resist_poison = rand(10, 15);
		$this->resist_energy = rand(10, 15);
		$this->karma = 200;
		$this->fame = 0;
		$this->virtualarmor = 16;

}}
?>
