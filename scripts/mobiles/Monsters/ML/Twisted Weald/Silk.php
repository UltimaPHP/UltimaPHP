<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class silk extends Mobile {
	public function summon() {
		$this->name = "silk";
		$this->body = 264;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(53, 214);
		$this->dex = rand(243, 367);
		$this->int = rand(369, 586);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 14;
		$this->damage_max = 20;
		$this->resist_physical = rand(85, 90);
		$this->resist_fire = rand(41, 46);
		$this->resist_cold = rand(40, 44);
		$this->resist_poison = rand(42, 46);
		$this->resist_energy = rand(45, 47);
		$this->karma = -21000;
		$this->fame = 21000;
		$this->virtualarmor = 0;

}}
?>
