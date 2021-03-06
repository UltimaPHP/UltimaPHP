<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Zombie extends Mobile {
	public function summon() {
		$this->name = "a zombie";
		$this->body = 3;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(46, 70);
		$this->dex = rand(31, 50);
		$this->int = rand(26, 40);
		$this->maxhits = rand(28, 42);
		$this->hits = $this->maxhits;
		$this->damage = 3;
		$this->damageMax = 7;
		$this->resist_physical = rand(15, 20);
		$this->resist_fire = 0;
		$this->resist_cold = rand(20, 30);
		$this->resist_poison = rand(5, 10);
		$this->resist_energy = 0;
		$this->karma = -600;
		$this->fame = 600;
		$this->virtualarmor = 18;

}}
?>
