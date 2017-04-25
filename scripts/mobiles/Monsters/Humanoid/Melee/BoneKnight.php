<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BoneKnight extends Mobile {
	public function summon() {
		$this->name = "a bone knight";
		$this->body = 57;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(196, 250);
		$this->dex = rand(76, 95);
		$this->int = rand(36, 60);
		$this->hits = 8;
		$this->maxhits = 18;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(30, 40);
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 40;

}}
?>
