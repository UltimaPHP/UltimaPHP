<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class harrower extends Mobile {
	public function summon() {
		$this->name = "the true harrower";
		$this->body = 780;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(900, 1000);
		$this->dex = rand(125, 135);
		$this->int = rand(1000, 1200);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 0;
		$this->damage_max = 0;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(60, 80);
		$this->resist_cold = rand(60, 80);
		$this->resist_poison = rand(60, 80);
		$this->resist_energy = rand(60, 80);
		$this->karma = -22500;
		$this->fame = 22500;
		$this->virtualarmor = 60;

}}
?>
