<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class mephitis extends Mobile {
	public function summon() {
		$this->name = "mephitis";
		$this->body = 173;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x183;
		$this->str = rand(505, 1000);
		$this->dex = rand(102, 300);
		$this->int = rand(402, 600);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 21;
		$this->damage_max = 33;
		$this->resist_physical = rand(75, 80);
		$this->resist_fire = rand(60, 70);
		$this->resist_cold = rand(60, 70);
		$this->resist_poison = 0;
		$this->resist_energy = rand(60, 70);
		$this->karma = -22500;
		$this->fame = 22500;
		$this->virtualarmor = 80;

}}
?>
