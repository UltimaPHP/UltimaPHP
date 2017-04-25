<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class MLDryad extends Mobile {
	public function summon() {
		$this->name = "a dryad";
		$this->body = 266;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x57B;
		$this->str = rand(132, 149);
		$this->dex = rand(152, 168);
		$this->int = rand(251, 280);
		$this->hits = 11;
		$this->maxhits = 20;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(40, 45);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(25, 35);
		$this->karma = 5000;
		$this->fame = 5000;
		$this->virtualarmor = 28;

}}
?>
