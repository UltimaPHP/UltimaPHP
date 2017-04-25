<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ShadowIronElemental extends Mobile {
	public function summon() {
		$this->name = "a shadow iron elemental";
		$this->body = 111;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(226, 255);
		$this->dex = rand(126, 145);
		$this->int = rand(71, 92);
		$this->hits = 9;
		$this->maxhits = 16;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(30, 40);
		$this->karma = -4500;
		$this->fame = 4500;
		$this->virtualarmor = 23;

}}
?>
