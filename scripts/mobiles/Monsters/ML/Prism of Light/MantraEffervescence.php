<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class mantraeffervescence extends Mobile {
	public function summon() {
		$this->name = "a mantra effervescence";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x56E;
		$this->str = rand(130, 150);
		$this->dex = rand(120, 130);
		$this->int = rand(150, 230);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 21;
		$this->damage_max = 25;
		$this->resist_physical = rand(60, 65);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = 0;
		$this->karma = -6500;
		$this->fame = 6500;
		$this->virtualarmor = 0;

}}
?>
