<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class axe extends Object {
	public function build() {
		$this->name = "axe";
		$this->graphic = 0xF49;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 35;
		$this->aosmindamage = 14;
		$this->aosmaxdamage = 16;
		$this->aosspeed = 37;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 35;
		$this->oldmindamage = 6;
		$this->oldspeed = 37;
		$this->defhitsound = 0x232;
		$this->defmisssound = 0x23A;
		$this->hits = 31;
		$this->maxHits = 110;
		$this->weight = 4.0;

}}
?>
