<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class GnarledStaff extends Object {
	public function build() {
		$this->name = "gnarled staff";
		$this->graphic = 0x13F8;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 20;
		$this->aosmindamage = 15;
		$this->aosmaxdamage = 17;
		$this->aosspeed = 33;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 20;
		$this->oldmindamage = 10;
		$this->oldspeed = 33;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 50;
		$this->weight = 3.0;

}}
?>
