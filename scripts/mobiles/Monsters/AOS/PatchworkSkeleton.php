<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class PatchworkSkeleton extends Mobile {
	public function summon() {
		$this->name = "a patchwork skeleton";
		$this->body = 309;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x48D;
		$this->str = rand(96, 120);
		$this->dex = rand(71, 95);
		$this->int = rand(16, 40);
		$this->hits = 18;
		$this->maxhits = 22;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(70, 80);
		$this->resist_poison = 0;
		$this->resist_energy = rand(40, 50);
		$this->karma = -500;
		$this->fame = 500;
		$this->virtualarmor = 54;

}}
?>
