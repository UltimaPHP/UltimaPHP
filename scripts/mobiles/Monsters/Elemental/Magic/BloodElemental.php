<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BloodElemental extends Mobile {
	public function summon() {
		$this->name = "a blood elemental";
		$this->body = 159;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(526, 615);
		$this->dex = rand(66, 85);
		$this->int = rand(226, 350);
		$this->hits = 17;
		$this->maxhits = 27;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(30, 40);
		$this->karma = -12500;
		$this->fame = 12500;
		$this->virtualarmor = 60;

}}
?>
