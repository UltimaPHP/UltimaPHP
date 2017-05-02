<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Oni extends Mobile {
	public function summon() {
		$this->name = "an oni";
		$this->body = 0x1CF0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(801, 910);
		$this->dex = rand(151, 300);
		$this->int = rand(171, 195);
		$this->maxhits = rand(401, 530);
		$this->hits = $this->maxhits;
		$this->damage = 14;
		$this->damageMax = 20;
		$this->resist_physical = rand(65, 80);
		$this->resist_fire = rand(50, 70);
		$this->resist_cold = rand(35, 50);
		$this->resist_poison = rand(45, 70);
		$this->resist_energy = rand(45, 65);
		$this->karma = -12000;
		$this->fame = 12000;
		$this->virtualarmor = 0;

}}
?>
