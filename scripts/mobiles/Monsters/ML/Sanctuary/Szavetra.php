<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class szavetra extends Mobile {
	public function summon() {
		$this->name = "szavetra";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(627, 655);
		$this->dex = rand(164, 193);
		$this->int = rand(566, 595);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 20;
		$this->damage_max = 30;
		$this->resist_physical = rand(83, 90);
		$this->resist_fire = rand(72, 80);
		$this->resist_cold = rand(40, 49);
		$this->resist_poison = rand(51, 60);
		$this->resist_energy = rand(50, 60);
		$this->karma = -24000;
		$this->fame = 24000;
		$this->virtualarmor = 0;

}}
?>
