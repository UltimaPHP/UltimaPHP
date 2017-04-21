<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class malefic extends Mobile {
	public function summon() {
		$this->name = "malefic";
		$this->body = 264;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(210, 284);
		$this->dex = rand(153, 197);
		$this->int = rand(349, 390);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 15;
		$this->damage_max = 22;
		$this->resist_physical = rand(60, 70);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(40, 49);
		$this->resist_poison = rand(70, 80);
		$this->resist_energy = rand(41, 48);
		$this->karma = -21000;
		$this->fame = 21000;
		$this->virtualarmor = 0;

}}
?>
