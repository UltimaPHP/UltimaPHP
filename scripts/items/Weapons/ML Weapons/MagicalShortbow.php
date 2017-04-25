<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class MagicalShortbow extends Object {
	public function build() {
		$this->name = "magical shortbow";
		$this->graphic = 0x2D2B;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 45;
		$this->aosmindamage = 9;
		$this->aosmaxdamage = 13;
		$this->aosspeed = 38;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 45;
		$this->oldmindamage = 9;
		$this->oldspeed = 38;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 41;
		$this->maxHits = 90;
		$this->weight = 6.0;

}}
?>
