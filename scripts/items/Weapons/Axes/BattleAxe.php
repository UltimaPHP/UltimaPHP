<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BattleAxe extends Object {
	public function build() {
		$this->name = "battle axe";
		$this->graphic = 0xF47;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 35;
		$this->aosmindamage = 15;
		$this->aosmaxdamage = 17;
		$this->aosspeed = 31;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 40;
		$this->oldmindamage = 6;
		$this->oldspeed = 30;
		$this->defhitsound = 0;
		$this->defmisssound = 0;
		$this->hits = 31;
		$this->maxHits = 70;
		$this->weight = 4.0;

}}
?>
