<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class elvenspellblade extends Object {
	public function build() {
		$this->name = "elven spellblade";
		$this->graphic = 0x2D20;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 35;
		$this->aosmindamage = 12;
		$this->aosmaxdamage = 14;
		$this->aosspeed = 44;
		$this->mlspeed = 2;
		$this->oldstrengthreq = 35;
		$this->oldmindamage = 12;
		$this->oldspeed = 44;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x239;
		$this->hits = 30;
		$this->maxHits = 60;
		$this->weight = 5.0;

}}
?>
