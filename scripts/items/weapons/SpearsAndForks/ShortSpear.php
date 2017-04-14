<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ShortSpear extends Object {
	public function build() {
		$this->name = "ShortSpear";
		$this->graphic = 0x1403;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 40;
		$this->aosmindamage = 10;
		$this->aosmaxdamage = 13;
		$this->aosspeed = 55;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 15;
		$this->oldmindamage = 4;
		$this->oldspeed = 50;
		$this->defhitsound = 0x23C;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 70;
		$this->weight = 4.0;

}}
?>
