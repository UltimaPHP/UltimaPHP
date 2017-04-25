<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class HellHound extends Mobile {
	public function summon() {
		$this->name = "a hell hound";
		$this->body = 98;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(102, 150);
		$this->dex = rand(81, 105);
		$this->int = rand(36, 60);
		$this->hits = 11;
		$this->maxhits = 17;
		$this->resist_physical = rand(25, 35);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = 0;
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(10, 20);
		$this->karma = -3400;
		$this->fame = 3400;
		$this->virtualarmor = 30;

}}
?>
