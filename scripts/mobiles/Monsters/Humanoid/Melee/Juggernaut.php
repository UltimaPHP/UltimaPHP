<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class juggernaut extends Mobile {
	public function summon() {
		$this->name = "a blackthorn juggernaut";
		$this->body = 768;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(301, 400);
		$this->dex = rand(51, 70);
		$this->int = rand(51, 100);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 12;
		$this->damage_max = 19;
		$this->resist_physical = rand(65, 75);
		$this->resist_fire = rand(35, 45);
		$this->resist_cold = rand(35, 45);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(10, 20);
		$this->karma = -12000;
		$this->fame = 12000;
		$this->virtualarmor = 70;

}}
?>
