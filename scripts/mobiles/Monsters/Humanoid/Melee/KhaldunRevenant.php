<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class khaldunrevenant extends Mobile {
	public function summon() {
		$this->name = "a revenant";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(401, 500);
		$this->dex = rand(296, 315);
		$this->int = rand(101, 200);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 20;
		$this->damage_max = 30;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(60, 70);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(20, 30);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 60;

}}
?>
