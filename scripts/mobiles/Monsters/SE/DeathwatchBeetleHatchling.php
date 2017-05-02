<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class DeathwatchBeetleHatchling extends Mobile {
	public function summon() {
		$this->name = "a deathwatch beetle hatchling";
		$this->body = 242;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(26, 50);
		$this->dex = rand(41, 52);
		$this->int = rand(21, 30);
		$this->maxhits = rand(51, 60);
		$this->hits = $this->maxhits;
		$this->damage = 2;
		$this->damageMax = 8;
		$this->resist_physical = rand(35, 40);
		$this->resist_fire = rand(15, 30);
		$this->resist_cold = rand(15, 30);
		$this->resist_poison = rand(20, 40);
		$this->resist_energy = rand(20, 35);
		$this->karma = -700;
		$this->fame = 700;
		$this->virtualarmor = 0;

}}
?>
