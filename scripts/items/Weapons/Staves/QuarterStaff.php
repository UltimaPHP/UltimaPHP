<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class quarterstaff extends Object {
	public function build() {
		$this->name = "quarter staff";
		$this->graphic = 0xE89;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0x480;
		$this->aosstrengthreq = 30;
		$this->aosmindamage = 11;
		$this->aosmaxdamage = 14;
		$this->aosspeed = 48;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 30;
		$this->oldmindamage = 8;
		$this->oldspeed = 48;
		$this->defhitsound = 0x233;
		$this->defmisssound = 0x239;
		$this->hits = 31;
		$this->maxHits = 60;
		$this->weight = 4.0;

}}
?>
