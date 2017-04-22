<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class dragon extends Mobile {
	public function summon() {
		$this->name = "a dragon";
		$this->body = 12;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(796, 825);
		$this->dex = rand(86, 105);
		$this->int = rand(436, 475);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 16;
		$this->damage_max = 22;
		$this->resist_physical = rand(55, 65);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(35, 45);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 60;

}}
?>
