<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class WarHammer extends TypeNormal {
	public function build() {
		$this->name = "war hammer";
		$this->graphic = 0x1439;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 95;
		$this->aosmindamage = 17;
		$this->aosmaxdamage = 18;
		$this->aosspeed = 28;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 40;
		$this->oldmindamage = 8;
		$this->oldspeed = 31;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 110;
		$this->weight = 10.0;

}}
?>
