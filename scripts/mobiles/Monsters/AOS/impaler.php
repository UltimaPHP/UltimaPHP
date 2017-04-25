<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Impaler extends Mobile {
	public function summon() {
		$this->name = "impaler";
		$this->body = 306;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x2A7;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->hits = 31;
		$this->maxhits = 35;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -24000;
		$this->fame = 24000;
		$this->virtualarmor = 49;

}}
?>
