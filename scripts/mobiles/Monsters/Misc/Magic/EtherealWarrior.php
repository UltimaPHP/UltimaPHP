<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class EtherealWarrior extends Mobile {
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
		$this->maxhits = rand(352, 471);
		$this->hits = $this->maxhits;
		$this->damage = 13;
		$this->damageMax = 19;
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
