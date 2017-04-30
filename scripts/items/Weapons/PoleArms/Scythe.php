<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class Scythe extends TypeNormal {
	public function build() {
		$this->name = "scythe";
		$this->graphic = 0x26BA;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 45;
		$this->aosmindamage = 15;
		$this->aosmaxdamage = 18;
		$this->aosspeed = 32;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 45;
		$this->oldmindamage = 15;
		$this->oldspeed = 32;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 100;
		$this->weight = 5.0;

}}
?>
