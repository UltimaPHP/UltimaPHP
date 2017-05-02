<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class IceElemental extends Mobile {
	public function summon() {
		$this->name = "an ice elemental";
		$this->body = 161;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(156, 185);
		$this->dex = rand(96, 115);
		$this->int = rand(171, 192);
		$this->maxhits = rand(94, 111);
		$this->hits = $this->maxhits;
		$this->damage = 10;
		$this->damageMax = 21;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(20, 30);
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 40;

}}
?>
