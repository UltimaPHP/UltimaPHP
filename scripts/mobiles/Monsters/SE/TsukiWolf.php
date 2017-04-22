<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class tsukiwolf extends Mobile {
	public function summon() {
		$this->name = "a tsuki wolf";
		$this->body = 250;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(401, 450);
		$this->dex = rand(151, 200);
		$this->int = rand(66, 76);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 14;
		$this->damage_max = 18;
		$this->resist_physical = rand(40, 60);
		$this->resist_fire = rand(50, 70);
		$this->resist_cold = rand(50, 70);
		$this->resist_poison = rand(50, 70);
		$this->resist_energy = rand(50, 70);
		$this->karma = -8500;
		$this->fame = 8500;
		$this->virtualarmor = 0;

}}
?>
