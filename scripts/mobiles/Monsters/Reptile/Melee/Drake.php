<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Drake extends Mobile {
	public function summon() {
		$this->name = "a drake";
		$this->body = 60;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(401, 430);
		$this->dex = rand(133, 152);
		$this->int = rand(101, 140);
		$this->maxhits = rand(241, 258);
		$this->hits = $this->maxhits;
		$this->damage = 11;
		$this->damageMax = 17;
		$this->resist_physical = rand(45, 50);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(40, 50);
		$this->resist_poison = rand(20, 30);
		$this->resist_energy = rand(30, 40);
		$this->karma = -5500;
		$this->fame = 5500;
		$this->virtualarmor = 46;

}}
?>
