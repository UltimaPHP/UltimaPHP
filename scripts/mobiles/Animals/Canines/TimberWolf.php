<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class TimberWolf extends Mobile {
	public function summon() {
		$this->name = "a timber wolf";
		$this->body = 225;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xE5;
		$this->str = rand(56, 80);
		$this->dex = rand(56, 75);
		$this->int = rand(11, 25);
		$this->maxhits = rand(34, 48);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 9;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(10, 15);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(5, 10);
		$this->karma = 0;
		$this->fame = 450;
		$this->virtualarmor = 16;

}}
?>
