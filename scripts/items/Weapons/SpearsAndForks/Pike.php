<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class pike extends Object {
	public function build() {
		$this->name = "pike";
		$this->graphic = 0x26BE;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 50;
		$this->aosmindamage = 14;
		$this->aosmaxdamage = 16;
		$this->aosspeed = 37;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 50;
		$this->oldmindamage = 14;
		$this->oldspeed = 37;
		$this->defhitsound = 0x23C;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 110;
		$this->weight = 8.0;

}}
?>
