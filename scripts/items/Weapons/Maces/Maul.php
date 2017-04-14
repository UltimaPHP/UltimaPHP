<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Maul extends Object {
	public function build() {
		$this->name = "Maul";
		$this->graphic = 0x143B;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0x47E;
		$this->aosstrengthreq = 45;
		$this->aosmindamage = 14;
		$this->aosmaxdamage = 16;
		$this->aosspeed = 32;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 20;
		$this->oldmindamage = 10;
		$this->oldspeed = 30;
		$this->defhitsound = 0x233;
		$this->defmisssound = 0x239;
		$this->hits = 31;
		$this->maxHits = 70;
		$this->weight = 10.0;

}}
?>
