<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Daisho extends Object {
	public function build() {
		$this->name = "daisho";
		$this->graphic = 0x27A9;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 40;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 40;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 40;
		$this->oldmindamage = 13;
		$this->oldspeed = 40;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x23A;
		$this->hits = 45;
		$this->maxHits = 65;
		$this->weight = 8.0;

}}
?>
