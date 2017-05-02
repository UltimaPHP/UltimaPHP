<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Ogre extends Mobile {
	public function summon() {
		$this->name = "an ogre";
		$this->body = 1;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(166, 195);
		$this->dex = rand(46, 65);
		$this->int = rand(46, 70);
		$this->maxhits = rand(100, 117);
		$this->hits = $this->maxhits;
		$this->damage = 9;
		$this->damageMax = 11;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = 0;
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 32;

}}
?>
