<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class largebattleaxe extends Object {
	public function build() {
		$this->name = "large battle axe";
		$this->graphic = 0x13FB;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 80;
		$this->aosmindamage = 16;
		$this->aosmaxdamage = 17;
		$this->aosspeed = 29;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 40;
		$this->oldmindamage = 6;
		$this->oldspeed = 30;
		$this->defhitsound = 0x232;
		$this->defmisssound = 0x23A;
		$this->hits = 31;
		$this->maxHits = 70;
		$this->weight = 6.0;

}}
?>
