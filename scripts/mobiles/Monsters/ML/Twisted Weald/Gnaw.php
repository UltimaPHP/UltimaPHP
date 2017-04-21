<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class gnaw extends Mobile {
	public function summon() {
		$this->name = "gnaw";
		$this->body = 264;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(82, 130);
		$this->dex = rand(117, 146);
		$this->int = rand(50, 98);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 15;
		$this->damage_max = 22;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(30, 39);
		$this->resist_poison = rand(70, 80);
		$this->resist_energy = rand(35, 44);
		$this->karma = -18900;
		$this->fame = 18900;
		$this->virtualarmor = 0;

}}
?>
