<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Wyvern extends Mobile {
	public function summon() {
		$this->name = "a wyvern";
		$this->body = 62;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(202, 240);
		$this->dex = rand(153, 172);
		$this->int = rand(51, 90);
		$this->maxhits = rand(125, 141);
		$this->hits = $this->maxhits;
		$this->damage = 8;
		$this->damageMax = 19;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(90, 100);
		$this->resist_energy = rand(30, 40);
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 40;

}}
?>
