<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Lance extends Object {
	public function build() {
		$this->name = "Lance";
		$this->graphic = 0x26C0;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 95;
		$this->aosmindamage = 17;
		$this->aosmaxdamage = 18;
		$this->aosspeed = 24;
		$this->mlspeed = 4;
		$this->oldstrengthreq = 95;
		$this->oldmindamage = 17;
		$this->oldspeed = 24;
		$this->defhitsound = 0x23C;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 110;
		$this->weight = 12.0;

}}
?>
