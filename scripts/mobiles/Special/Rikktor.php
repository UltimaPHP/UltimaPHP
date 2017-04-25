<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Rikktor extends Mobile {
	public function summon() {
		$this->name = "rikktor";
		$this->body = 172;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(701, 900);
		$this->dex = rand(201, 350);
		$this->int = rand(51, 100);
		$this->hits = 28;
		$this->maxhits = 55;
		$this->resist_physical = rand(80, 90);
		$this->resist_fire = rand(80, 90);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(80, 90);
		$this->resist_energy = rand(80, 90);
		$this->karma = -22500;
		$this->fame = 22500;
		$this->virtualarmor = 130;

}}
?>
