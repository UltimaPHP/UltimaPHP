<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class MeerWarrior extends Mobile {
	public function summon() {
		$this->name = "a meer warrior";
		$this->body = 771;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(86, 100);
		$this->dex = rand(186, 200);
		$this->int = rand(86, 100);
		$this->maxhits = rand(52, 60);
		$this->hits = $this->maxhits;
		$this->damage = 12;
		$this->damageMax = 19;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(5, 15);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(25, 35);
		$this->karma = 5000;
		$this->fame = 2000;
		$this->virtualarmor = 22;

}}
?>
