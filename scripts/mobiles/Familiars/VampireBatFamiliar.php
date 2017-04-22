<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class vampirebatfamiliar extends Mobile {
	public function summon() {
		$this->name = "a vampire bat";
		$this->body = 317;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0x270;
		$this->str = 0;
		$this->dex = 0;
		$this->int = 0;
		$this->hits = 0;
		$this->maxhits = 0;
		$this->damage_min = 5;
		$this->damage_max = 10;
		$this->resist_physical = rand(10, 15);
		$this->resist_fire = rand(10, 15);
		$this->resist_cold = rand(10, 15);
		$this->resist_poison = rand(10, 15);
		$this->resist_energy = rand(10, 15);
		$this->karma = 0;
		$this->fame = 0;
		$this->virtualarmor = 0;

}}
?>
