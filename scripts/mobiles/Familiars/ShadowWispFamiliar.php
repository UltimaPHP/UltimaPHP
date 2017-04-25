<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ShadowWispFamiliar extends Mobile {
	public function summon() {
		$this->name = "a shadow wisp";
		$this->body = 165;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->hits = 5;
		$this->maxhits = 10;
		$this->resist_physical = rand(10, 15);
		$this->resist_fire = rand(10, 15);
		$this->resist_cold = rand(10, 15);
		$this->resist_poison = rand(10, 15);
		$this->resist_energy = 0;
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
