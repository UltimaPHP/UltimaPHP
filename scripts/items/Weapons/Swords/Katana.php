<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Katana extends Object {
	public function build() {
		$this->name = "katana";
		$this->graphic = 0x13FF;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 25;
		$this->aosmindamage = 11;
		$this->aosmaxdamage = 13;
		$this->aosspeed = 46;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 10;
		$this->oldmindamage = 5;
		$this->oldspeed = 58;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x23A;
		$this->hits = 31;
		$this->maxHits = 90;
		$this->weight = 6.0;

}}
?>
