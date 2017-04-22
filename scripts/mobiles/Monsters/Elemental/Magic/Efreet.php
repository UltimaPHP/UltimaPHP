<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class efreet extends Mobile {
	public function summon() {
		$this->name = "an efreet";
		$this->body = 131;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(326, 355);
		$this->dex = rand(266, 285);
		$this->int = rand(171, 195);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 11;
		$this->damage_max = 13;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = 0;
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(40, 50);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 56;

}}
?>
