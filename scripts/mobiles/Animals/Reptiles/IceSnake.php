<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class IceSnake extends Mobile {
	public function summon() {
		$this->name = "an ice snake";
		$this->body = 52;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0xDB;
		$this->str = rand(42, 54);
		$this->dex = rand(36, 45);
		$this->int = rand(26, 30);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 4;
		$this->damageMax = 12;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = 0;
		$this->resist_cold = rand(80, 90);
		$this->resist_poison = rand(60, 70);
		$this->resist_energy = rand(30, 40);
		$this->karma = -900;
		$this->fame = 900;
		$this->virtualarmor = 30;

}}
?>
