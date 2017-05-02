<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BlackSolenWarrior extends Mobile {
	public function summon() {
		$this->name = "a black solen warrior";
		$this->body = 806;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(196, 220);
		$this->dex = rand(101, 125);
		$this->int = rand(36, 60);
		$this->maxhits = rand(96, 107);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 15;
		$this->resist_physical = rand(20, 35);
		$this->resist_fire = rand(20, 35);
		$this->resist_cold = rand(10, 25);
		$this->resist_poison = rand(20, 35);
		$this->resist_energy = rand(10, 25);
		$this->karma = -3000;
		$this->fame = 3000;
		$this->virtualarmor = 35;

}}
?>
