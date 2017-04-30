<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Tessen extends TypeNormal {
	public function build() {
		$this->name = "tessen";
		$this->graphic = 0x27A3;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 10;
		$this->aosmindamage = 10;
		$this->aosmaxdamage = 12;
		$this->aosspeed = 50;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 10;
		$this->oldmindamage = 10;
		$this->oldspeed = 50;
		$this->defhitsound = 0x232;
		$this->defmisssound = 0x238;
		$this->hits = 55;
		$this->maxHits = 60;
		$this->weight = 6.0;

}}
?>
