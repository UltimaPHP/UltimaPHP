<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WarMace extends Object {
	public function build() {
		$this->name = "war mace";
		$this->graphic = 0x1407;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 80;
		$this->aosmindamage = 16;
		$this->aosmaxdamage = 17;
		$this->aosspeed = 26;
		$this->mlspeed = 4;
		$this->oldstrengthreq = 30;
		$this->oldmindamage = 10;
		$this->oldspeed = 32;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 110;
		$this->weight = 17.0;

}}
?>
