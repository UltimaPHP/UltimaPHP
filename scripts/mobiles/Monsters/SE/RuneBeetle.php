<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class RuneBeetle extends Mobile {
	public function summon() {
		$this->name = "a rune beetle";
		$this->body = 244;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(401, 460);
		$this->dex = rand(121, 170);
		$this->int = rand(376, 450);
		$this->maxhits = rand(301, 360);
		$this->hits = $this->maxhits;
		$this->damage = 15;
		$this->damageMax = 22;
		$this->resist_physical = rand(40, 65);
		$this->resist_fire = rand(35, 50);
		$this->resist_cold = rand(35, 50);
		$this->resist_poison = rand(75, 95);
		$this->resist_energy = rand(40, 60);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 0;

}}
?>
