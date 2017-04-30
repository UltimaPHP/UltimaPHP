<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WarAxe extends TypeNormal {
	public function build() {
		$this->name = "war axe";
		$this->graphic = 0x13B0;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 35;
		$this->aosmindamage = 14;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 33;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 35;
		$this->oldmindamage = 9;
		$this->oldspeed = 40;
		$this->defhitsound = 0x233;
		$this->defmisssound = 0x239;
		$this->hits = 31;
		$this->maxHits = 80;
		$this->weight = 8.0;

}}
?>
