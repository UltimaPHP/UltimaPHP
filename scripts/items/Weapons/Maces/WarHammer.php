<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WarHammer extends Object {
	public function build() {
		$this->name = "WarHammer";
		$this->graphic = 0x1439;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0x47E;
		$this->aosstrengthreq = 95;
		$this->aosmindamage = 17;
		$this->aosmaxdamage = 18;
		$this->aosspeed = 28;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 40;
		$this->oldmindamage = 8;
		$this->oldspeed = 31;
		$this->defhitsound = 0x233;
		$this->defmisssound = 0x239;
		$this->hits = 31;
		$this->maxHits = 110;
		$this->weight = 10.0;

}}
?>
