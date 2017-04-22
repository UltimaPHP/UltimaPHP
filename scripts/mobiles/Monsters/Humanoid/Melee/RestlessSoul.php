<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class restlesssoul extends Mobile {
	public function summon() {
		$this->name = "restless soul";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(26, 40);
		$this->dex = rand(26, 40);
		$this->int = rand(26, 40);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 1;
		$this->damage_max = 10;
		$this->resist_physical = rand(15, 25);
		$this->resist_fire = rand(5, 15);
		$this->resist_cold = rand(25, 40);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(10, 20);
		$this->karma = -500;
		$this->fame = 500;
		$this->virtualarmor = 6;

}}
?>
