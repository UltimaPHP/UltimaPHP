<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Mace extends Object {
	public function build() {
		$this->name = "mace";
		$this->graphic = 0xF5C;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 45;
		$this->aosmindamage = 12;
		$this->aosmaxdamage = 14;
		$this->aosspeed = 40;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 20;
		$this->oldmindamage = 8;
		$this->oldspeed = 30;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 70;
		$this->weight = 14.0;

}}
?>
