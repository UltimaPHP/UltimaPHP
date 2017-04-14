<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WarFork extends Object {
	public function build() {
		$this->name = "WarFork";
		$this->graphic = 0x1405;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 45;
		$this->aosmindamage = 12;
		$this->aosmaxdamage = 13;
		$this->aosspeed = 43;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 35;
		$this->oldmindamage = 4;
		$this->oldspeed = 45;
		$this->defhitsound = 0x236;
		$this->defmisssound = 0x238;
		$this->hits = 31;
		$this->maxHits = 110;
		$this->weight = 9.0;

}}
?>
