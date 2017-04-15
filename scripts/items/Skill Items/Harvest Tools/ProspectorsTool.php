<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class prospectorstool extends Object {
	public function build() {
		$this->name = "prospectors tool";
		$this->graphic = 0xFB4;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0x0;
		$this->aosstrengthreq = 40;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 33;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 10;
		$this->oldmindamage = 6;
		$this->oldspeed = 33;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 60;
		$this->weight = 9.0;

}}
?>
