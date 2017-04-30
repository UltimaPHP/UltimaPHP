<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GargoylesPickaxe extends TypeNormal {
	public function build() {
		$this->name = "gargoyles pickaxe";
		$this->graphic = 0xE85;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0x0;
		$this->aosstrengthreq = 50;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 35;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 25;
		$this->oldmindamage = 1;
		$this->oldspeed = 35;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 60;
		$this->weight = 11.0;

}}
?>
