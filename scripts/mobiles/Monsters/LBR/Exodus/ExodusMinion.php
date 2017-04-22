<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class exodusminion extends Mobile {
	public function summon() {
		$this->name = "exodus minion";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(851, 950);
		$this->dex = rand(71, 80);
		$this->int = rand(61, 90);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 16;
		$this->damage_max = 22;
		$this->resist_physical = rand(60, 70);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(15, 25);
		$this->resist_poison = rand(15, 25);
		$this->resist_energy = rand(15, 25);
		$this->karma = -18000;
		$this->fame = 18000;
		$this->virtualarmor = 65;

}}
?>
