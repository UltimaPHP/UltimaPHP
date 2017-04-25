<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class JukaWarrior extends Mobile {
	public function summon() {
		$this->name = "a juka warrior";
		$this->body = 764;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(251, 350);
		$this->dex = rand(61, 80);
		$this->int = rand(101, 150);
		$this->hits = 7;
		$this->maxhits = 9;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(25, 35);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(10, 20);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 22;

}}
?>
