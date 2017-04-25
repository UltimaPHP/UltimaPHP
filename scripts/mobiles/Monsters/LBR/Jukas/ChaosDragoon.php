<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ChaosDragoon extends Mobile {
	public function summon() {
		$this->name = "a chaos dragoon";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(176, 225);
		$this->dex = rand(81, 95);
		$this->int = rand(61, 85);
		$this->hits = 24;
		$this->maxhits = 26;
		$this->resist_physical = rand(25, 38);
		$this->resist_fire = rand(25, 38);
		$this->resist_cold = rand(25, 38);
		$this->resist_poison = rand(25, 38);
		$this->resist_energy = rand(25, 38);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 0;

}}
?>
