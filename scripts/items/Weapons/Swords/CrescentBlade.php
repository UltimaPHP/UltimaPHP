<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class CrescentBlade extends TypeNormal {
	public function build() {
		$this->name = "crescent blade";
		$this->graphic = 0x26C1;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 55;
		$this->aosmindamage = 11;
		$this->aosmaxdamage = 14;
		$this->aosspeed = 47;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 55;
		$this->oldmindamage = 11;
		$this->oldspeed = 47;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x23A;
		$this->hits = 51;
		$this->maxHits = 80;
		$this->weight = 1.0;

}}
?>
