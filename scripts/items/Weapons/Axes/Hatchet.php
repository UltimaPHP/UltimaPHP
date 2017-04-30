<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Hatchet extends TypeNormal {
	public function build() {
		$this->name = "hatchet";
		$this->graphic = 0xF43;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 20;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 41;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 15;
		$this->oldmindamage = 2;
		$this->oldspeed = 40;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 80;
		$this->weight = 4.0;

}}
?>
