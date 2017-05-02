<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Titan extends Mobile {
	public function summon() {
		$this->name = "a titan";
		$this->body = 76;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(536, 585);
		$this->dex = rand(126, 145);
		$this->int = rand(281, 305);
		$this->maxhits = rand(322, 351);
		$this->hits = $this->maxhits;
		$this->damage = 13;
		$this->damageMax = 16;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -11500;
		$this->fame = 11500;
		$this->virtualarmor = 40;

}}
?>
