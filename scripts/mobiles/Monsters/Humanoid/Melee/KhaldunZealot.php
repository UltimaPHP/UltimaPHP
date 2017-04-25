<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class KhaldunZealot extends Mobile {
	public function summon() {
		$this->name = "zealot of khaldun";
		$this->body = 0;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(351, 400);
		$this->dex = rand(151, 165);
		$this->int = rand(76, 100);
		$this->hits = 15;
		$this->maxhits = 25;
		$this->resist_physical = rand(35, 45);
		$this->resist_fire = rand(25, 30);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = rand(25, 35);
		$this->resist_energy = rand(25, 35);
		$this->karma = -10000;
		$this->fame = 10000;
		$this->virtualarmor = 40;

}}
?>
