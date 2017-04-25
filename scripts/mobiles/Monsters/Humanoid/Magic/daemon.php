<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class daemon_mage extends Mobile {
	public function summon() {
		$this->name = "daemon";
		$this->body = 9;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(476, 505);
		$this->dex = rand(76, 95);
		$this->int = rand(301, 325);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 7;
		$this->damage_max = 14;
		$this->resist_physical = rand(45, 60);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(30, 40);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 58;

}}
?>
