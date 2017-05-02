<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BoneDemon extends Mobile {
	public function summon() {
		$this->name = "a bone demon";
		$this->body = 308;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x48D;
		$this->str = 0;
		$this->dex = rand(151, 175);
		$this->int = rand(171, 220);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 34;
		$this->damageMax = 36;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -20000;
		$this->fame = 20000;
		$this->virtualarmor = 44;

}}
?>
