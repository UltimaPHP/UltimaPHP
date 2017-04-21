<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class miasma extends Mobile {
	public function summon() {
		$this->name = "miasma";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(255, 847);
		$this->dex = rand(145, 428);
		$this->int = rand(26, 380);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 20;
		$this->damage_max = 30;
		$this->resist_physical = rand(50, 54);
		$this->resist_fire = rand(40, 45);
		$this->resist_cold = rand(50, 55);
		$this->resist_poison = rand(70, 80);
		$this->resist_energy = rand(40, 45);
		$this->karma = -21000;
		$this->fame = 21000;
		$this->virtualarmor = 0;

}}
?>
