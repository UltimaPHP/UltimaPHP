<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class DoubleBladedStaff extends Object {
	public function build() {
		$this->name = "double bladed staff";
		$this->graphic = 0x26BF;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 50;
		$this->aosmindamage = 12;
		$this->aosmaxdamage = 13;
		$this->aosspeed = 49;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 50;
		$this->oldmindamage = 12;
		$this->oldspeed = 49;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 80;
		$this->weight = 2.0;

}}
?>
