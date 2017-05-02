<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class HordeMinionFamiliar extends Mobile {
	public function summon() {
		$this->name = "a horde minion";
		$this->body = 776;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x39D;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 5;
		$this->damageMax = 10;
		$this->resist_physical = rand(50, 60);
		$this->resist_fire = rand(50, 55);
		$this->resist_cold = 0;
		$this->resist_poison = rand(25, 30);
		$this->resist_energy = rand(25, 30);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
