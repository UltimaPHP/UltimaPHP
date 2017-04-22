<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class hordeminion extends Mobile {
	public function summon() {
		$this->name = "a horde minion";
		$this->body = 776;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(16, 40);
		$this->dex = rand(31, 60);
		$this->int = rand(11, 25);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 10;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -500;
		$this->fame = 500;
		$this->virtualarmor = 18;

}}
?>
