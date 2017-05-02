<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Betrayer extends Mobile {
	public function summon() {
		$this->name = "a betrayer";
		$this->body = 767;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(401, 500);
		$this->dex = rand(81, 100);
		$this->int = rand(151, 200);
		$this->maxhits = rand(241, 300);
		$this->hits = $this->maxhits;
		$this->damage = 16;
		$this->damageMax = 22;
		$this->resist_physical = rand(60, 70);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = rand(60, 70);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(20, 30);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 65;

}}
?>
