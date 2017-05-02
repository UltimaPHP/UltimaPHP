<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SummonedWaterElemental extends Mobile {
	public function summon() {
		$this->name = "a water elemental";
		$this->body = 16;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 12;
		$this->damageMax = 16;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(70, 80);
		$this->resist_poison = rand(45, 55);
		$this->resist_energy = rand(40, 50);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 40;

}}
?>
