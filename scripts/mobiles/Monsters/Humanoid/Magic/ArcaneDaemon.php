<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class arcanedaemon extends Mobile {
	public function summon() {
		$this->name = "an arcane daemon";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x47D;
		$this->str = rand(131, 150);
		$this->dex = rand(126, 145);
		$this->int = rand(301, 350);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 12;
		$this->damage_max = 16;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(70, 80);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(30, 40);
		$this->karma = -10000;
		$this->fame = 7000;
		$this->virtualarmor = 55;

}}
?>
