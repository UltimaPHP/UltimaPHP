<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class nodachi extends Object {
	public function build() {
		$this->name = "no dachi";
		$this->graphic = 0x27A2;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 40;
		$this->aosmindamage = 16;
		$this->aosmaxdamage = 18;
		$this->aosspeed = 35;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 40;
		$this->oldmindamage = 16;
		$this->oldspeed = 35;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x23A;
		$this->hits = 31;
		$this->maxHits = 90;
		$this->weight = 10.0;

}}
?>
