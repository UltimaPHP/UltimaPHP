<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class ElvenCompositeLongbow extends TypeNormal {
	public function build() {
		$this->name = "elven composite longbow";
		$this->graphic = 0x2D1E;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 45;
		$this->aosmindamage = 12;
		$this->aosmaxdamage = 16;
		$this->aosspeed = 27;
		$this->mlspeed = 4;
		$this->oldstrengthreq = 45;
		$this->oldmindamage = 12;
		$this->oldspeed = 27;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 41;
		$this->maxHits = 90;
		$this->weight = 8.0;

}}
?>
