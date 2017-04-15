<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class bow extends Object {
	public function build() {
		$this->name = "bow";
		$this->graphic = 0x13B2;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 30;
		$this->aosmindamage = 0;
		$this->aosmaxdamage = 0;
		$this->aosspeed = 25;
		$this->mlspeed = 4;
		$this->oldstrengthreq = 20;
		$this->oldmindamage = 9;
		$this->oldspeed = 20;
		$this->defhitsound = 0x234;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 60;
		$this->weight = 6.0;

}}
?>
