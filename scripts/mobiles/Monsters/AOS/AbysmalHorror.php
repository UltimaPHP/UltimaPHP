<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class abysmalhorror extends Mobile {
	public function summon() {
		$this->name = "an abyssmal horror";
		$this->body = 312;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x451;
		$this->str = rand(401, 420);
		$this->dex = rand(81, 90);
		$this->int = rand(401, 420);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 13;
		$this->damage_max = 17;
		$this->resist_physical = rand(30, 35);
		$this->resist_fire = 0;
		$this->resist_cold = rand(50, 55);
		$this->resist_poison = rand(60, 65);
		$this->resist_energy = rand(77, 80);
		$this->karma = -26000;
		$this->fame = 26000;
		$this->virtualarmor = 54;

}}
?>
