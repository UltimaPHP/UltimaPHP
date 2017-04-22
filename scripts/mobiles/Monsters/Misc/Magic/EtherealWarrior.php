<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class etherealwarrior extends Mobile {
	public function summon() {
		$this->name = "ethereal warrior";
		$this->body = 123;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(586, 785);
		$this->dex = rand(177, 255);
		$this->int = rand(351, 450);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 13;
		$this->damage_max = 19;
		$this->resist_physical = rand(80, 90);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(40, 50);
		$this->karma = 7000;
		$this->fame = 7000;
		$this->virtualarmor = 120;

}}
?>
