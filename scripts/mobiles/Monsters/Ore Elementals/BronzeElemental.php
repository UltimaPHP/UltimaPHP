<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class bronzeelemental extends Mobile {
	public function summon() {
		$this->name = "a bronze elemental";
		$this->body = 108;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(226, 255);
		$this->dex = rand(126, 145);
		$this->int = rand(71, 92);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 9;
		$this->damage_max = 16;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(70, 80);
		$this->resist_energy = rand(20, 30);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 29;

}}
?>
