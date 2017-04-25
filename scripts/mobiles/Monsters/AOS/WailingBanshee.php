<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WailingBanshee extends Mobile {
	public function summon() {
		$this->name = "a wailing banshee";
		$this->body = 310;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x482;
		$this->str = rand(126, 150);
		$this->dex = rand(76, 100);
		$this->int = rand(86, 110);
		$this->hits = 10;
		$this->maxhits = 14;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(25, 30);
		$this->resist_cold = rand(70, 80);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(40, 50);
		$this->karma = -1500;
		$this->fame = 1500;
		$this->virtualarmor = 19;

}}
?>
