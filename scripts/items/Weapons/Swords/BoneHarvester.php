<?php

/**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/

class BoneHarvester extends Object {
	public function build() {
		$this->name = "bone harvester";
		$this->graphic = 0x26BB;
		$this->type = "";
		$this->flags = 0x00;
		$this->value = 0;
		$this->amount = 1;
		$this->color = 0;
		$this->aosstrengthreq = 25;
		$this->aosmindamage = 13;
		$this->aosmaxdamage = 15;
		$this->aosspeed = 36;
		$this->mlspeed = 3;
		$this->oldstrengthreq = 25;
		$this->oldmindamage = 13;
		$this->oldspeed = 36;
		$this->defhitsound = 0x23B;
		$this->defmisssound = 0x23A;
		$this->hits = 31;
		$this->maxHits = 70;
		$this->weight = 3.0;

}}
?>
