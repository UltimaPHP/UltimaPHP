<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class headlessone extends Mobile {
	public function summon() {
		$this->name = "a headless one";
		$this->body = 31;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x39D;
		$this->str = rand(26, 50);
		$this->dex = rand(36, 55);
		$this->int = rand(16, 30);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 10;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -450;
		$this->fame = 450;
		$this->virtualarmor = 18;

}}
?>
