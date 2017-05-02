<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Bull extends Mobile {
	public function summon() {
		$this->name = "a bull";
		$this->body = Functions::RandomList(array(8, 0));
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x64;
		$this->str = rand(77, 111);
		$this->dex = rand(56, 75);
		$this->int = rand(47, 75);
		$this->maxhits = rand(50, 64);
		$this->hits = $this->maxhits;
		$this->damage = 4;
		$this->damageMax = 9;
		$this->resist_physical = rand(25, 30);
		$this->resist_fire = 0;
		$this->resist_cold = rand(10, 15);
		$this->resist_poison = 0;
		$this->resist_energy = 0;
		$this->karma = 0;
		$this->fame = 600;
		$this->virtualarmor = 28;

}}
?>
