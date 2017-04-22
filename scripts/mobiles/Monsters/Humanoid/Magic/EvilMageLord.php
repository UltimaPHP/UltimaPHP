<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class evilmagelord extends Mobile {
	public function summon() {
		$this->name = "evil mage lord";
		$this->body = Functions::RandomList(array(125, 126));
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(81, 105);
		$this->dex = rand(191, 215);
		$this->int = rand(126, 150);
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 10;
		$this->resist_physical = rand(35, 40);
		$this->resist_fire = rand(30, 40);
		$this->resist_cold = rand(30, 40);
		$this->resist_poison = rand(30, 40);
		$this->resist_energy = rand(30, 40);
		$this->karma = -10500;
		$this->fame = 10500;
		$this->virtualarmor = 16;

}}
?>
