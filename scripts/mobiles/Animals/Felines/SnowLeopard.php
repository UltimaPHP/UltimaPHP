<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class snowleopard extends Mobile {
	public function summon() {
		$this->name = "a snow leopard";
		$this->body = Functions::RandomList(array(64, 65));
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x73;
		$this->str = rand(56, 80);
		$this->dex = rand(66, 85);
		$this->int = rand(26, 50);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 3;
		$this->damage_max = 9;
		$this->resist_physical = rand(20, 25);
		$this->resist_fire = rand(5, 10);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(10, 20);
		$this->resist_energy = rand(20, 30);
		$this->karma = 0;
		$this->fame = 450;
		$this->virtualarmor = 24;

}}
?>
