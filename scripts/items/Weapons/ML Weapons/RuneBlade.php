<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class RuneBlade extends TypeNormal {
	public function build() {
		$this->name = "rune blade";
		$this->graphic = 0x2D32;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 30;
		$this->aosmindamage = 15;
		$this->aosmaxdamage = 17;
		$this->aosspeed = 35;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 30;
		$this->oldmindamage = 15;
		$this->oldspeed = 35;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x239;
		$this->hits = 30;
		$this->maxHits = 60;
		$this->weight = 7.0;

}}
?>
