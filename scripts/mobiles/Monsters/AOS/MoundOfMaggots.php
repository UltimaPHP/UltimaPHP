<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class MoundOfMaggots extends Mobile {
	public function summon() {
		$this->name = "a mound of maggots";
		$this->body = 319;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(61, 70);
		$this->dex = rand(61, 70);
		$this->int = 0;
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 3;
		$this->damageMax = 9;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 24;

}}
?>
