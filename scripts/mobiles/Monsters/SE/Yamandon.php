<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Yamandon extends Mobile {
	public function summon() {
		$this->name = "a yamandon";
		$this->body = 249;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(786, 930);
		$this->dex = rand(251, 365);
		$this->int = rand(101, 115);
		$this->maxhits = rand(1601, 1800);
		$this->hits = $this->maxhits;
		$this->damage = 19;
		$this->damageMax = 35;
		$this->resist_physical = rand(65, 85);
		$this->resist_fire = rand(70, 90);
		$this->resist_cold = rand(50, 70);
		$this->resist_poison = rand(50, 70);
		$this->resist_energy = rand(50, 70);
		$this->karma = -22000;
		$this->fame = 22000;
		$this->virtualarmor = 0;

}}
?>
