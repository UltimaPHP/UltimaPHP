<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class EnergyVortex extends Mobile {
	public function summon() {
		$this->name = "an energy vortex";
		$this->body = 164;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->hits = 14;
		$this->maxhits = 17;
		$this->resist_physical = rand(60, 70);
		$this->resist_fire = rand(40, 50);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(40, 50);
		$this->resist_energy = rand(90, 100);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 40;

}}
?>
