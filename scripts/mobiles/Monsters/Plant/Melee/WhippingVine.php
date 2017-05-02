<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WhippingVine extends Mobile {
	public function summon() {
		$this->name = "a whipping vine";
		$this->body = 8;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(251, 300);
		$this->dex = rand(76, 100);
		$this->int = rand(26, 40);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 7;
		$this->damageMax = 25;
		$this->resist_physical = rand(75, 85);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(75, 85);
		$this->resist_energy = rand(35, 45);
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 45;

}}
?>
