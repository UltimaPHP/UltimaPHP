<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class nunchaku extends Object {
	public function build() {
		$this->name = "nunchaku";
		$this->graphic = 0x27AE;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 15;
		$this->aosmindamage = 11;
		$this->aosmaxdamage = 13;
		$this->aosspeed = 47;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 15;
		$this->oldmindamage = 11;
		$this->oldspeed = 47;
		$this->defhitsound = 0x535;
		$this->defmisssound = 0x239;
		$this->hits = 40;
		$this->maxHits = 55;
		$this->weight = 5.0;

}}
?>
