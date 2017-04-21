<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class virulent extends Mobile {
	public function summon() {
		$this->name = "virulent";
		$this->body = 264;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(207, 252);
		$this->dex = rand(156, 194);
		$this->int = rand(346, 398);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 15;
		$this->damage_max = 22;
		$this->resist_physical = rand(60, 68);
		$this->resist_fire = rand(40, 49);
		$this->resist_cold = rand(41, 50);
		$this->resist_poison = rand(55, 85);
		$this->resist_energy = rand(40, 49);
		$this->karma = -21000;
		$this->fame = 21000;
		$this->virtualarmor = 0;

}}
?>
