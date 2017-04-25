<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WandererOfTheVoid extends Mobile {
	public function summon() {
		$this->name = "a wanderer of the void";
		$this->body = 316;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(111, 200);
		$this->dex = rand(101, 125);
		$this->int = rand(301, 390);
		$this->hits = 11;
		$this->maxhits = 13;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(15, 25);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(50, 75);
		$this->resist_energy = rand(40, 50);
		$this->karma = -20000;
		$this->fame = 20000;
		$this->virtualarmor = 44;

}}
?>
