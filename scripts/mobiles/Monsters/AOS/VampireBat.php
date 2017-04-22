<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class vampirebat extends Mobile {
	public function summon() {
		$this->name = "a vampire bat";
		$this->body = 317;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x270;
		$this->str = rand(91, 110);
		$this->dex = rand(91, 115);
		$this->int = rand(26, 50);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 7;
		$this->damage_max = 9;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(40, 50);
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 14;

}}
?>
