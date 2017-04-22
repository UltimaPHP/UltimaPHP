<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class crystaldaemon extends Mobile {
	public function summon() {
		$this->name = "a crystal daemon";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x47D;
		$this->str = rand(140, 200);
		$this->dex = rand(120, 150);
		$this->int = rand(800, 850);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 16;
		$this->damage_max = 20;
		$this->resist_physical = rand(20, 40);
		$this->resist_fire = rand(0, 20);
		$this->resist_cold = rand(60, 80);
		$this->resist_poison = rand(20, 40);
		$this->resist_energy = rand(65, 75);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 0;

}}
?>
