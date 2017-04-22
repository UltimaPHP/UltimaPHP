<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class bakekitsune extends Mobile {
	public function summon() {
		$this->name = "a bake kitsune";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(171, 220);
		$this->dex = rand(126, 145);
		$this->int = rand(376, 425);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 15;
		$this->damage_max = 22;
		$this->resist_physical = rand(40, 60);
		$this->resist_fire = rand(70, 90);
		$this->resist_cold = rand(40, 60);
		$this->resist_poison = rand(40, 60);
		$this->resist_energy = rand(40, 60);
		$this->karma = -8000;
		$this->fame = 8000;
		$this->virtualarmor = 0;

}}
?>
