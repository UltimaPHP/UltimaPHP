<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class FleshRenderer extends Mobile {
	public function summon() {
		$this->name = "a fleshrenderer";
		$this->body = 315;
		$this->type = "";
		$this->flags = 0x00;
		$this->color = 0x00;
		$this->basesoundid = 0;
		$this->str = rand(401, 460);
		$this->dex = rand(201, 210);
		$this->int = rand(221, 260);
		$this->maxhits = 0;
		$this->hits = $this->maxhits;
		$this->damage = 16;
		$this->damageMax = 20;
		$this->resist_physical = rand(80, 90);
		$this->resist_fire = rand(50, 60);
		$this->resist_cold = rand(50, 60);
		$this->resist_poison = 0;
		$this->resist_energy = rand(70, 80);
		$this->karma = -23000;
		$this->fame = 23000;
		$this->virtualarmor = 24;

}}
?>
