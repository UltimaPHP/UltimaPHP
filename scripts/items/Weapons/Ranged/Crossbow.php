<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Crossbow extends TypeNormal {
	public function build() {
		$this->name = "crossbow";
		$this->graphic = 0xF50;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 35;
		$this->aosmindamage = 18;
		$this->aosmaxdamage = 0;
		$this->aosspeed = 24;
		$this->mlspeed = 4;
		$this->oldstrengthreq = 30;
		$this->oldmindamage = 8;
		$this->oldspeed = 18;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 80;
		$this->weight = 7.0;

}}
?>
