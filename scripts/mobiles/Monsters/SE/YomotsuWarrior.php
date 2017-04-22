<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class yomotsuwarrior extends Mobile {
	public function summon() {
		$this->name = "a yomotsu warrior";
		$this->body = 245;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x452;
		$this->str = rand(486, 530);
		$this->dex = rand(151, 165);
		$this->int = rand(17, 31);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 8;
		$this->damage_max = 10;
		$this->resist_physical = rand(65, 85);
		$this->resist_fire = rand(30, 50);
		$this->resist_cold = rand(45, 65);
		$this->resist_poison = rand(35, 55);
		$this->resist_energy = rand(25, 50);
		$this->karma = -4200;
		$this->fame = 4200;
		$this->virtualarmor = 0;

}}
?>
