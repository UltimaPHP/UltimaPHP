<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class RedSolenWorker extends Mobile {
	public function summon() {
		$this->name = "a red solen worker";
		$this->body = 781;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(96, 120);
		$this->dex = rand(81, 105);
		$this->int = rand(36, 60);
		$this->hits = 5;
		$this->maxhits = 7;
		$this->resist_physical = rand(25, 30);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(10, 20);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(20, 30);
		$this->karma = -1500;
		$this->fame = 1500;
		$this->virtualarmor = 28;

}}
?>