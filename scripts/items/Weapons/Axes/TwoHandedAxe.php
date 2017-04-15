<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class twohandedaxe extends Object {
	public function build() {
		$this->name = "two handed axe";
		$this->graphic = 0x1443;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 40;
		$this->aosmindamage = 16;
		$this->aosmaxdamage = 17;
		$this->aosspeed = 31;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 35;
		$this->oldmindamage = 5;
		$this->oldspeed = 30;
		$this->defhitsound = 0x232;
		$this->defmisssound = 0x23A;
		$this->hits = 31;
		$this->maxHits = 90;
		$this->weight = 8.0;

}}
?>
