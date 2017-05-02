<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class OrcBomber extends Mobile {
	public function summon() {
		$this->name = "an orc bomber";
		$this->body = 182;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x45A;
		$this->str = rand(147, 215);
		$this->dex = rand(91, 115);
		$this->int = rand(61, 85);
		$this->maxhits = rand(95, 123);
		$this->hits = $this->maxhits;
		$this->damage = 1;
		$this->damageMax = 8;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(15, 20);
		$this->resist_energy = rand(25, 30);
		$this->karma = -2500;
		$this->fame = 2500;
		$this->virtualarmor = 30;

}}
?>
