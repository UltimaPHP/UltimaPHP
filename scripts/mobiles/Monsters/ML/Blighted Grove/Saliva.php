<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class saliva extends Mobile {
	public function summon() {
		$this->name = "saliva";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x16A;
		$this->str = rand(110, 206);
		$this->dex = rand(123, 222);
		$this->int = rand(80, 127);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 20;
		$this->damage_max = 22;
		$this->resist_physical = rand(46, 48);
		$this->resist_fire = rand(32, 40);
		$this->resist_cold = rand(34, 49);
		$this->resist_poison = rand(40, 48);
		$this->resist_energy = rand(35, 39);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
