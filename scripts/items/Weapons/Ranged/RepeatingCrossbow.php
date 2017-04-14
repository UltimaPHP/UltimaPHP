<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class RepeatingCrossbow extends Object {
	public function build() {
		$this->name = "RepeatingCrossbow";
		$this->graphic = 0x26C3;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0x453;
		$this->aosstrengthreq = 30;
		$this->aosmindamage = 18;
		$this->aosmaxdamage = 12;
		$this->aosspeed = 41;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 30;
		$this->oldmindamage = 10;
		$this->oldspeed = 41;
		$this->defhitsound = 0x234;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 80;
		$this->weight = 6.0;

}}
?>
