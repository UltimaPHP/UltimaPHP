<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Pitchfork extends Object {
	public function build() {
		$this->name = "pitchfork";
		$this->graphic = 0xE87;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 55;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 14;
		$this->aosspeed = 43;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 15;
		$this->oldmindamage = 4;
		$this->oldspeed = 45;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 60;
		$this->weight = 11.0;

}}
?>
