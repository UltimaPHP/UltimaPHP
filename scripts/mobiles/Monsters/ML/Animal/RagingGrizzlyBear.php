<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class RagingGrizzlyBear extends Mobile {
	public function summon() {
		$this->name = "a raging grizzly bear";
		$this->body = 212;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xA3;
		$this->str = rand(1251, 1550);
		$this->dex = rand(801, 1050);
		$this->int = rand(151, 400);
		$this->maxhits = rand(751, 930);
		$this->hits = $this->maxhits;
		$this->damage = 18;
		$this->damageMax = 23;
		$this->resist_physical = rand(50, 70);
		$this->resist_fire = 0;
		$this->resist_cold = rand(30, 50);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(10, 20);
		$this->karma = 10000;
		$this->fame = 10000;
		$this->virtualarmor = 24;

}}
?>
