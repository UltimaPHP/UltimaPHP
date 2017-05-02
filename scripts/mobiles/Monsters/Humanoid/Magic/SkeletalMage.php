<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SkeletalMage extends Mobile {
	public function summon() {
		$this->name = "a skeletal mage";
		$this->body = 148;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(76, 100);
		$this->dex = rand(56, 75);
		$this->int = rand(186, 210);
		$this->maxhits = rand(46, 60);
		$this->hits = $this->maxhits;
		$this->damage = 3;
		$this->damageMax = 7;
		$this->resist_physical = rand(35, 40);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(30, 40);
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 38;

}}
?>
