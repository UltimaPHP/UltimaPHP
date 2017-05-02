<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BladeSpirits extends Mobile {
	public function summon() {
		$this->name = "a blade spirit";
		$this->body = 574;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 10;
		$this->damageMax = 14;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = 0;
		$this->resist_energy = rand(20, 30);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 40;

}}
?>
