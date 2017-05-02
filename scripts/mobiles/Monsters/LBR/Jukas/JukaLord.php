<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class JukaLord extends Mobile {
	public function summon() {
		$this->name = "a juka lord";
		$this->body = 766;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(401, 500);
		$this->dex = rand(81, 100);
		$this->int = rand(151, 200);
		$this->maxhits = rand(241, 300);
		$this->hits = $this->maxhits;
		$this->damage = 10;
		$this->damageMax = 12;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(45, 50);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(20, 25);
		$this->resist_energy = rand(40, 50);
		$this->karma = -15000;
		$this->fame = 15000;
		$this->virtualarmor = 28;

}}
?>
