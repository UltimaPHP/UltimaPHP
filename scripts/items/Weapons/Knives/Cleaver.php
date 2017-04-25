<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Cleaver extends Object {
	public function build() {
		$this->name = "cleaver";
		$this->graphic = 0xEC3;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 10;
		$this->aosmindamage = 11;
		$this->aosmaxdamage = 13;
		$this->aosspeed = 46;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 10;
		$this->oldmindamage = 2;
		$this->oldspeed = 40;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 50;
		$this->weight = 2.0;

}}
?>
