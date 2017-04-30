<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class OrnateAxe extends TypeNormal {
	public function build() {
		$this->name = "ornate axe";
		$this->graphic = 0x2D28;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 45;
		$this->aosmindamage = 18;
		$this->aosmaxdamage = 20;
		$this->aosspeed = 26;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 45;
		$this->oldmindamage = 18;
		$this->oldspeed = 26;
		$this->defhitsound = 0;
		$this->defmisssound = 0x239;
		$this->hits = 30;
		$this->maxHits = 60;
		$this->weight = 12.0;

}}
?>
