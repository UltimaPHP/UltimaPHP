<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class AncientLich extends Mobile {
	public function summon() {
		$this->name = "ancient lich";
		$this->body = 78;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(216, 305);
		$this->dex = rand(96, 115);
		$this->int = rand(966, 1045);
		$this->maxhits = rand(560, 595);
		$this->hits = $this->maxhits;
		$this->damage = 15;
		$this->damageMax = 27;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(25, 30);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(25, 30);
		$this->karma = -23000;
		$this->fame = 23000;
		$this->virtualarmor = 60;

}}
?>
