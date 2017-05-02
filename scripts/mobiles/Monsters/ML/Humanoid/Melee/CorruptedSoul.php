<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class CorruptedSoul extends Mobile {
	public function summon() {
		$this->name = "a corrupted soul";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(102, 115);
		$this->dex = rand(101, 115);
		$this->int = rand(203, 215);
		$this->maxhits = rand(61, 69);
		$this->hits = $this->maxhits;
		$this->damage = 4;
		$this->damageMax = 40;
		$this->resist_physical = rand(61, 74);
		$this->resist_fire = rand(22, 48);
		$this->resist_cold = rand(73, 100);
		$this->resist_poison = 0;
		$this->resist_energy = rand(51, 60);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 6;

}}
?>
