<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ElfBrigand extends Mobile {
	public function summon() {
		$this->name = "male elf brigand";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(86, 100);
		$this->dex = rand(81, 95);
		$this->int = rand(61, 75);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 10;
		$this->damageMax = 23;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -1000;
		$this->fame = 1000;
		$this->virtualarmor = 0;

}}
?>
