<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Wisp extends Mobile {
	public function summon() {
		$this->name = "a wisp";
		$this->body = 58;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(196, 225);
		$this->dex = rand(196, 225);
		$this->int = rand(196, 225);
		$this->hits = 17;
		$this->maxhits = 18;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(20, 40);
		$this->resist_cold = rand(10, 30);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = rand(50, 70);
		$this->karma = 0;
		$this->fame = 4000;
		$this->virtualarmor = 40;

}}
?>
