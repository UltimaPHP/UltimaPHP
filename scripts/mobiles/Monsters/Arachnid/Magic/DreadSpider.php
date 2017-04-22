<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class dreadspider extends Mobile {
	public function summon() {
		$this->name = "a dread spider";
		$this->body = 11;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(196, 220);
		$this->dex = rand(126, 145);
		$this->int = rand(286, 310);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 17;
		$this->resist_physical = rand(40, 50);
		$this->resist_fire = rand(20, 30);
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(90, 100);
		$this->resist_energy = rand(20, 30);
		$this->karma = -5000;
		$this->fame = 5000;
		$this->virtualarmor = 36;

}}
?>
