<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class FrostOoze extends Mobile {
	public function summon() {
		$this->name = "a frost ooze";
		$this->body = 94;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(18, 30);
		$this->dex = rand(16, 21);
		$this->int = rand(16, 20);
		$this->maxhits = rand(13, 17);
		$this->hits = $this->maxhits;
		$this->damage = 3;
		$this->damageMax = 9;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = 0;
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(10, 20);
		$this->karma = -450;
		$this->fame = 450;
		$this->virtualarmor = 38;

}}
?>
