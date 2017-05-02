<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Leviathan extends Mobile {
	public function summon() {
		$this->name = "a leviathan";
		$this->body = 77;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = 0;
		$this->dex = rand(501, 520);
		$this->int = rand(501, 515);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 25;
		$this->damageMax = 33;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(45, 55);
		$this->resist_cold = rand(45, 55);
		$this->resist_poison = rand(35, 45);
		$this->resist_energy = rand(25, 35);
		$this->karma = -24000;
		$this->fame = 24000;
		$this->virtualarmor = 50;

}}
?>
