<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class swoop extends Mobile {
	public function summon() {
		$this->name = "swoop";
		$this->body = 264;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(100, 150);
		$this->dex = rand(400, 500);
		$this->int = rand(80, 90);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 20;
		$this->damage_max = 30;
		$this->resist_physical = rand(75, 90);
		$this->resist_fire = rand(60, 77);
		$this->resist_cold = rand(70, 85);
		$this->resist_poison = rand(55, 85);
		$this->resist_energy = rand(50, 60);
		$this->karma = 0;
		$this->fame = 18000;
		$this->virtualarmor = 0;

}}
?>
