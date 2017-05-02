<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Lizardman extends Mobile {
	public function summon() {
		$this->name = "lizardman";
		$this->body = Functions::RandomList(array(35, 36));
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(96, 120);
		$this->dex = rand(86, 105);
		$this->int = rand(36, 60);
		$this->maxhits = rand(58, 72);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 7;
		$this->resist_physical = rand(25, 30);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(5, 10);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = 0;
		$this->karma = -1500;
		$this->fame = 1500;
		$this->virtualarmor = 28;

}}
?>
