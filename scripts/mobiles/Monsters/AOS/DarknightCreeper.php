<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class DarknightCreeper extends Mobile {
	public function summon() {
		$this->name = "darknight creeper";
		$this->body = 313;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xE0;
		$this->str = rand(301, 330);
		$this->dex = rand(101, 110);
		$this->int = rand(301, 330);
		$this->hits = 22;
		$this->maxhits = 26;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -22000;
		$this->fame = 22000;
		$this->virtualarmor = 34;

}}
?>
