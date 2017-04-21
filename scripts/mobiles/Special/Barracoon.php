<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class barracoon extends Mobile {
	public function summon() {
		$this->name = "barracoon";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(305, 425);
		$this->dex = rand(72, 150);
		$this->int = rand(505, 750);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 25;
		$this->damage_max = 35;
		$this->resist_physical = rand(60, 70);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(40, 50);
		$this->karma = -22500;
		$this->fame = 22500;
		$this->virtualarmor = 70;

}}
?>
