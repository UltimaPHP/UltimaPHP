<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GargoyleEnforcer extends Mobile {
	public function summon() {
		$this->name = "gargoyle enforcer";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x174;
		$this->str = rand(760, 850);
		$this->dex = rand(102, 150);
		$this->int = rand(152, 200);
		$this->maxhits = rand(482, 485);
		$this->hits = $this->maxhits;
		$this->damage = 7;
		$this->damageMax = 14;
		$this->resist_physical = rand(40, 60);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(15, 25);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 50;

}}
?>
