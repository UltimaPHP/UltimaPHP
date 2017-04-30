<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class VikingSword extends TypeWeaponSword {
    public function build() {
        $this->name           = "viking sword";
        $this->graphic        = 0x13B9;
        $this->flags          = 0x00;
        $this->value          = 0;
        $this->amount         = 1;
        $this->color          = 0;
        $this->aosstrengthreq = 40;
        $this->aosmindamage   = 15;
        $this->aosmaxdamage   = 17;
        $this->aosspeed       = 28;
        $this->mlspeed        = 3;
        $this->oldstrengthreq = 40;
        $this->oldmindamage   = 6;
        $this->oldspeed       = 30;
        $this->defhitsound    = 0x237;
        $this->defmisssound   = 0x23A;
        $this->hits           = 31;
        $this->maxHits        = 100;
        $this->weight         = 6.0;
    }
}