<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class LadyOfTheSnow extends Mobile {
	public function summon() {
		$this->name = "a lady of the snow";
		$this->body = 252;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x482;
		$this->str = rand(276, 305);
		$this->dex = rand(106, 125);
		$this->int = rand(471, 495);
		$this->maxhits = rand(596, 625);
		$this->hits = $this->maxhits;
		$this->damage = 13;
		$this->damageMax = 20;
		$this->resist_physical = rand(45, 55);
		$this->resist_fire = rand(40, 55);
		$this->resist_cold = rand(70, 90);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(65, 85);
		$this->karma = -15200;
		$this->fame = 15200;
		$this->virtualarmor = 0;

}}
?>
