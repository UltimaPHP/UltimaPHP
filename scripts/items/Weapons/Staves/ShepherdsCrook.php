<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ShepherdsCrook extends Object {
	public function build() {
		$this->name = "shepherds crook";
		$this->graphic = 0xE81;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 20;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 40;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 10;
		$this->oldmindamage = 3;
		$this->oldspeed = 30;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 50;
		$this->weight = 4.0;

}}
?>
