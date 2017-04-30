<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Tetsubo extends TypeNormal {
	public function build() {
		$this->name = "tetsubo";
		$this->graphic = 0x27A6;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 35;
		$this->aosmindamage = 12;
		$this->aosmaxdamage = 14;
		$this->aosspeed = 45;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 35;
		$this->oldmindamage = 12;
		$this->oldspeed = 45;
		$this->defhitsound = 0x233;
		$this->defmisssound = 0x238;
		$this->hits = 60;
		$this->maxHits = 65;
		$this->weight = 8.0;

}}
?>
