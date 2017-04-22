<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class summonedearthelemental extends Mobile {
	public function summon() {
		$this->name = "an earth elemental";
		$this->body = 14;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 14;
		$this->damage_max = 21;
		$this->resist_physical = rand(65, 75);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(40, 50);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 34;

}}
?>
