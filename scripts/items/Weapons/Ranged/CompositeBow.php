<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class CompositeBow extends Object {
	public function build() {
		$this->name = "CompositeBow";
		$this->graphic = 0x26C2;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 45;
		$this->aosmindamage = 0;
		$this->aosmaxdamage = 17;
		$this->aosspeed = 25;
		$this->mlspeed = 4;
		$this->oldstrengthreq = 45;
		$this->oldmindamage = 15;
		$this->oldspeed = 25;
		$this->defhitsound = 0x234;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 70;
		$this->weight = 5.0;

}}
?>
