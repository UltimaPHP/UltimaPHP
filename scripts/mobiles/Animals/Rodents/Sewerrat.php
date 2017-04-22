<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class sewerrat extends Mobile {
	public function summon() {
		$this->name = "a sewer rat";
		$this->body = 238;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xCC;
		$this->str = 0;
		$this->dex = 0;
		$this->int = rand(6, 10);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 1;
		$this->damage_max = 2;
		$this->resist_physical = rand(5, 10);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(5, 10);
		$this->karma = -300;
		$this->fame = 300;
		$this->virtualarmor = 6;

}}
?>
