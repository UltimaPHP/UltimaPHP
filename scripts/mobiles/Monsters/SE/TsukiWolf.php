<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class TsukiWolf extends Mobile {
	public function summon() {
		$this->name = "a tsuki wolf";
		$this->body = 250;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(401, 450);
		$this->dex = rand(151, 200);
		$this->int = rand(66, 76);
		$this->maxhits = rand(376, 450);
		$this->hits = $this->maxhits;
		$this->damage = 14;
		$this->damageMax = 18;
		$this->resist_physical = rand(40, 60);
		$this->resist_fire = rand(50, 70);
		$this->resist_cold = rand(50, 70);
		$this->resist_poison = rand(50, 70);
		$this->resist_energy = rand(50, 70);
		$this->karma = -8500;
		$this->fame = 8500;
		$this->virtualarmor = 0;

}}
?>
