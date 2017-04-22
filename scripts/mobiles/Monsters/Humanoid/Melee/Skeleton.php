<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class skeleton extends Mobile {
	public function summon() {
		$this->name = "a skeleton";
		$this->body = Functions::RandomList(array(50, 56));
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x48D;
		$this->str = rand(56, 80);
		$this->dex = rand(56, 75);
		$this->int = rand(16, 40);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 3;
		$this->damage_max = 7;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(25, 40);
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(5, 15);
		$this->karma = -450;
		$this->fame = 450;
		$this->virtualarmor = 16;

}}
?>
