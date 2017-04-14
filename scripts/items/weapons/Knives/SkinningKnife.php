<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class SkinningKnife extends Object {
	public function build() {
		$this->name = "SkinningKnife";
		$this->graphic = 0xEC4;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 5;
		$this->aosmindamage = 9;
		$this->aosmaxdamage = 11;
		$this->aosspeed = 49;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 5;
		$this->oldmindamage = 1;
		$this->oldspeed = 40;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 40;
		$this->weight = 1.0;

}}
?>
