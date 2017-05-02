<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ChaosDaemon extends Mobile {
	public function summon() {
		$this->name = "a chaos daemon";
		$this->body = 792;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x3E9;
		$this->str = rand(106, 130);
		$this->dex = rand(171, 200);
		$this->int = rand(56, 80);
		$this->maxhits = rand(91, 110);
		$this->hits = $this->maxhits;
		$this->damage = 12;
		$this->damageMax = 17;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(20, 30);
		$this->karma = -4000;
		$this->fame = 3000;
		$this->virtualarmor = 15;

}}
?>
