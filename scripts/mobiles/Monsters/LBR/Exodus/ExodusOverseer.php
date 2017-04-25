<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ExodusOverseer extends Mobile {
	public function summon() {
		$this->name = "exodus overseer";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(561, 650);
		$this->dex = rand(76, 95);
		$this->int = rand(61, 90);
		$this->hits = 13;
		$this->maxhits = 19;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(40, 60);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(25, 35);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 50;

}}
?>
