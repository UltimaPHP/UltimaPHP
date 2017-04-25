<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Scepter extends Object {
	public function build() {
		$this->name = "scepter";
		$this->graphic = 0x26BC;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 40;
		$this->aosmindamage = 14;
		$this->aosmaxdamage = 17;
		$this->aosspeed = 30;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 40;
		$this->oldmindamage = 14;
		$this->oldspeed = 30;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 110;
		$this->weight = 8.0;

}}
?>
