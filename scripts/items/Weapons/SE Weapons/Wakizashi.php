<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Wakizashi extends Object {
	public function build() {
		$this->name = "wakizashi";
		$this->graphic = 0x27A4;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 20;
		$this->aosmindamage = 11;
		$this->aosmaxdamage = 13;
		$this->aosspeed = 44;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 20;
		$this->oldmindamage = 11;
		$this->oldspeed = 44;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x23A;
		$this->hits = 45;
		$this->maxHits = 50;
		$this->weight = 5.0;

}}
?>
