<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class lurg extends Mobile {
	public function summon() {
		$this->name = "lurg";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(584, 625);
		$this->dex = rand(163, 176);
		$this->int = rand(90, 106);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 16;
		$this->damage_max = 19;
		$this->resist_physical = rand(50, 53);
		$this->resist_fire = rand(45, 47);
		$this->resist_cold = rand(56, 60);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(41, 56);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 0;

}}
?>
