<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GolemController extends Mobile {
	public function summon() {
		$this->name = "golem controller";
		$this->body = 400;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(126, 150);
		$this->dex = rand(96, 120);
		$this->int = rand(151, 175);
		$this->maxhits = rand(76, 90);
		$this->hits = $this->maxhits;
		$this->damage = 6;
		$this->damageMax = 12;
		$this->resist_physical = rand(30, 40);
		$this->resist_fire = rand(25, 35);
		$this->resist_cold = rand(35, 45);
		$this->resist_poison = rand(5, 15);
		$this->resist_energy = rand(15, 25);
		$this->karma = -4000;
		$this->fame = 4000;
		$this->virtualarmor = 16;

}}
?>
