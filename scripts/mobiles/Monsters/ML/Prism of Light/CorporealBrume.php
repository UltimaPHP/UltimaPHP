<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class CorporealBrume extends Mobile {
	public function summon() {
		$this->name = "a corporeal brume";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x56B;
		$this->str = rand(400, 450);
		$this->dex = rand(100, 150);
		$this->int = rand(50, 60);
		$this->hits = 21;
		$this->maxhits = 25;
		$this->resist_physical = 0;
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(50, 60);
		$this->resist_energy = rand(30, 40);
		$this->karma = -12000;
		$this->fame = 12000;
		$this->virtualarmor = 0;

}}
?>
