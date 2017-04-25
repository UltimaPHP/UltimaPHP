<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GreatHart extends Mobile {
	public function summon() {
		$this->name = "a great hart";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(41, 71);
		$this->dex = rand(47, 77);
		$this->int = rand(27, 57);
		$this->hits = 5;
		$this->maxhits = 9;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = 0;
		$this->resist_cold = rand(5, 10);
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = 0;
		$this->fame = 300;
		$this->virtualarmor = 24;

}}
?>
