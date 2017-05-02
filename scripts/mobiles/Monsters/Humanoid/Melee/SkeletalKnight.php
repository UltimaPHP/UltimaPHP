<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SkeletalKnight extends Mobile {
	public function summon() {
		$this->name = "a skeletal knight";
		$this->body = 147;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(196, 250);
		$this->dex = rand(76, 95);
		$this->int = rand(36, 60);
		$this->maxhits = rand(118, 150);
		$this->hits = $this->maxhits;
		$this->damage = 8;
		$this->damageMax = 18;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(30, 40);
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 40;

}}
?>
