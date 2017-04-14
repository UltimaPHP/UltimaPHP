<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ElvenMachete extends Object {
	public function build() {
		$this->name = "ElvenMachete";
		$this->graphic = 0x2D35;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 20;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 41;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 20;
		$this->oldmindamage = 13;
		$this->oldspeed = 41;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x239;
		$this->hits = 30;
		$this->maxHits = 60;
		$this->weight = 6.0;

}}
?>
