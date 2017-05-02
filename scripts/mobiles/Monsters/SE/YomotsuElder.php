<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class YomotsuElder extends Mobile {
	public function summon() {
		$this->name = "a yomotsu elder";
		$this->body = 255;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x452;
		$this->str = rand(686, 830);
		$this->dex = rand(251, 365);
		$this->int = rand(17, 31);
		$this->maxhits = rand(801, 900);
		$this->hits = $this->maxhits;
		$this->damage = 19;
		$this->damageMax = 27;
		$this->resist_physical = rand(65, 85);
		$this->resist_fire = rand(30, 50);
		$this->resist_cold = rand(45, 65);
		$this->resist_poison = rand(35, 55);
		$this->resist_energy = rand(25, 50);
		$this->karma = -12000;
		$this->fame = 12000;
		$this->virtualarmor = 0;

}}
?>
