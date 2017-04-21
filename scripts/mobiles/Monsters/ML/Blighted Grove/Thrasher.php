<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class thrasher extends Mobile {
	public function summon() {
		$this->name = "thrasher";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x16A;
		$this->str = rand(93, 327);
		$this->dex = rand(7, 201);
		$this->int = rand(15, 67);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 20;
		$this->damage_max = 30;
		$this->resist_physical = rand(50, 55);
		$this->resist_fire = rand(25, 29);
		$this->resist_cold = rand(30, 35);
		$this->resist_poison = rand(25, 28);
		$this->resist_energy = rand(41, 45);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
