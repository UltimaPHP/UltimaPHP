<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class pyre extends Mobile {
	public function summon() {
		$this->name = "pyre";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(605, 611);
		$this->dex = rand(391, 519);
		$this->int = rand(669, 818);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 20;
		$this->damage_max = 30;
		$this->resist_physical = rand(50, 54);
		$this->resist_fire = rand(72, 75);
		$this->resist_cold = rand(50, 55);
		$this->resist_poison = rand(36, 41);
		$this->resist_energy = rand(50, 51);
		$this->karma = -21000;
		$this->fame = 21000;
		$this->virtualarmor = 0;

}}
?>
