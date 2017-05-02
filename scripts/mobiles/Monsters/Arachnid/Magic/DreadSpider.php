<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class DreadSpider extends Mobile {
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
		$this->maxhits = rand(118, 132);
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 17;
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
