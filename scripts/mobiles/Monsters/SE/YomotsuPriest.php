<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class YomotsuPriest extends Mobile {
	public function summon() {
		$this->name = "a yomotsu priest";
		$this->body = 253;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x452;
		$this->str = rand(486, 530);
		$this->dex = rand(101, 115);
		$this->int = rand(601, 670);
		$this->maxhits = rand(486, 530);
		$this->hits = $this->maxhits;
		$this->damage = 8;
		$this->damageMax = 10;
		$this->resist_physical = rand(65, 85);
		$this->resist_fire = rand(30, 50);
		$this->resist_cold = rand(45, 65);
		$this->resist_poison = rand(35, 55);
		$this->resist_energy = rand(25, 50);
		$this->karma = -9000;
		$this->fame = 9000;
		$this->virtualarmor = 0;

}}
?>
