<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class harrowertentacles extends Mobile {
	public function summon() {
		$this->name = "tentacles of the harrower";
		$this->body = 129;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(901, 1000);
		$this->dex = rand(126, 140);
		$this->int = rand(1001, 1200);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 13;
		$this->damage_max = 20;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(35, 45);
		$this->resist_cold = rand(35, 45);
		$this->resist_poison = rand(35, 45);
		$this->resist_energy = rand(35, 45);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 60;

}}
?>
