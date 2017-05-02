<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Bogle extends Mobile {
	public function summon() {
		$this->name = "a bogle";
		$this->body = 153;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x482;
		$this->str = rand(76, 100);
		$this->dex = rand(76, 95);
		$this->int = rand(36, 60);
		$this->maxhits = rand(46, 60);
		$this->hits = $this->maxhits;
		$this->damage = 7;
		$this->damageMax = 11;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 28;

}}
?>
