<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Halberd extends Object {
	public function build() {
		$this->name = "Halberd";
		$this->graphic = 0x143E;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 95;
		$this->aosmindamage = 18;
		$this->aosmaxdamage = 19;
		$this->aosspeed = 25;
		$this->mlspeed = 4;
		$this->oldstrengthreq = 45;
		$this->oldmindamage = 5;
		$this->oldspeed = 25;
		$this->defhitsound = 0x237;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 80;
		$this->weight = 16.0;

}}
?>
