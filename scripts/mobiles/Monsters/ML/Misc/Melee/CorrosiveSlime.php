<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class CorrosiveSlime extends Mobile {
	public function summon() {
		$this->name = "a corrosive slime";
		$this->body = 51;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(22, 34);
		$this->dex = rand(16, 21);
		$this->int = rand(16, 20);
		$this->maxhits = rand(15, 19);
		$this->hits = $this->maxhits;
		$this->damage = 1;
		$this->damageMax = 5;
		$this->resist_physical = rand(5, 10);
		$this->resist_fire = 0;
		$this->resist_cold = 0;
		$this->resist_poison = rand(15, 20);
		$this->resist_energy = 0;
		$this->karma = -300;
		$this->fame = 300;
		$this->virtualarmor = 8;

}}
?>
