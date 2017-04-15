<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class warcleaver extends Object {
	public function build() {
		$this->name = "war cleaver";
		$this->graphic = 0x2D2F;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 15;
		$this->aosmindamage = 9;
		$this->aosmaxdamage = 11;
		$this->aosspeed = 48;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 15;
		$this->oldmindamage = 9;
		$this->oldspeed = 48;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x239;
		$this->hits = 30;
		$this->maxHits = 60;
		$this->weight = 10.0;

}}
?>
