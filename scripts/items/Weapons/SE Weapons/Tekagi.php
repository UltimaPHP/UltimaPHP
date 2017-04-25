<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Tekagi extends Object {
	public function build() {
		$this->name = "tekagi";
		$this->graphic = 0x27AB;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 10;
		$this->aosmindamage = 10;
		$this->aosmaxdamage = 12;
		$this->aosspeed = 53;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 10;
		$this->oldmindamage = 10;
		$this->oldspeed = 53;
		$this->defhitsound = 0x238;
		$this->defmisssound = 0x232;
		$this->hits = 35;
		$this->maxHits = 60;
		$this->weight = 5.0;

}}
?>
