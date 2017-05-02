<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GreaterMongbat extends Mobile {
	public function summon() {
		$this->name = "a greater mongbat";
		$this->body = 39;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(56, 80);
		$this->dex = rand(61, 80);
		$this->int = rand(26, 50);
		$this->maxhits = rand(34, 48);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 7;
		$this->resist_physical = rand(15, 25);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -450;
		$this->fame = 450;
		$this->virtualarmor = 10;

}}
?>
