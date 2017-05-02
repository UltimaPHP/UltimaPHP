<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Neira extends Mobile {
	public function summon() {
		$this->name = "neira";
		$this->body = 401;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(305, 425);
		$this->dex = rand(72, 150);
		$this->int = rand(505, 750);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 25;
		$this->damageMax = 35;
		$this->resist_physical = rand(25, 30);
		$this->resist_fire = rand(35, 45);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(20, 30);
		$this->karma = -22500;
		$this->fame = 22500;
		$this->virtualarmor = 30;

}}
?>
