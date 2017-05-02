<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BaseEnraged extends Mobile {
	public function summon() {
		$this->name = "an eagle";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x2ee;
		$this->str = rand(50, 200);
		$this->dex = rand(50, 200);
		$this->int = 0;
		$this->maxhits = rand(50, 200);
		$this->hits = $this->maxhits;
		$this->damage = 0;
		$this->damageMax = 0;
		$this->resist_physical = 0;
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = -1000;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
