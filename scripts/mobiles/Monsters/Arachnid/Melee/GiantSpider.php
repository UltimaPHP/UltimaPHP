<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GiantSpider extends Mobile {
	public function summon() {
		$this->name = "a giant spider";
		$this->body = 28;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x388;
		$this->str = rand(76, 100);
		$this->dex = rand(76, 95);
		$this->int = rand(36, 60);
		$this->maxhits = rand(46, 60);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 13;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = 0;
		$this->karma = -600;
		$this->fame = 600;
		$this->virtualarmor = 16;

}}
?>
