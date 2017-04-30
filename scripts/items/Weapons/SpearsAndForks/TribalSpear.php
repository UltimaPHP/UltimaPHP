<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class TribalSpear extends TypeNormal {
	public function build() {
		$this->name = "tribal spear";
		$this->graphic = 0xF62;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 50;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 42;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 30;
		$this->oldmindamage = 2;
		$this->oldspeed = 46;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 80;
		$this->weight = 7.0;

}}
?>
