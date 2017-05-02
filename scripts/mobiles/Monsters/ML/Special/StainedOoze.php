<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class StainedOoze extends Mobile {
	public function summon() {
		$this->name = "ilhenir";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(1105, 1350);
		$this->dex = rand(82, 160);
		$this->int = rand(505, 750);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 21;
		$this->damageMax = 28;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(55, 65);
		$this->resist_poison = rand(70, 90);
		$this->resist_energy = rand(65, 75);
		$this->karma = -50000;
		$this->fame = 50000;
		$this->virtualarmor = 44;

}}
?>
