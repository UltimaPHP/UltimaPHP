<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class CrystalElemental extends Mobile {
	public function summon() {
		$this->name = "a crystal elemental";
		$this->body = 300;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(136, 160);
		$this->dex = rand(51, 65);
		$this->int = rand(86, 110);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 10;
		$this->damageMax = 15;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = 0;
		$this->resist_energy = rand(55, 70);
		$this->karma = -6500;
		$this->fame = 6500;
		$this->virtualarmor = 54;

}}
?>
