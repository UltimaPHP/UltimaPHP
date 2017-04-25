<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Dagger extends Object {
	public function build() {
		$this->name = "dagger";
		$this->graphic = 0xF52;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 10;
		$this->aosmindamage = 10;
		$this->aosmaxdamage = 11;
		$this->aosspeed = 56;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 1;
		$this->oldmindamage = 3;
		$this->oldspeed = 55;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 40;
		$this->weight = 1.0;

}}
?>
