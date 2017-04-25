<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BrownBear extends Mobile {
	public function summon() {
		$this->name = "a brown bear";
		$this->body = 167;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xA3;
		$this->str = rand(76, 100);
		$this->dex = rand(26, 45);
		$this->int = rand(23, 47);
		$this->hits = 6;
		$this->maxhits = 12;
		$this->resist_physical = rand(20, 30);
		$this->resist_fire = 0;
		$this->resist_cold = rand(15, 20);
		$this->resist_poison = rand(10, 15);
		$this->resist_energy = 0;
		$this->karma = 0;
		$this->fame = 450;
		$this->virtualarmor = 24;

}}
?>
