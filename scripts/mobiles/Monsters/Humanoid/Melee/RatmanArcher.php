<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class RatmanArcher extends Mobile {
    public function summon() {
        $this->name            = "ratman archer";
        $this->body            = 0;
        $this->type            = "";
        $this->flags           = 0x00;
        $this->color           = 0x00;
        $this->basesoundid     = 0;
        $this->str             = rand(146, 180);
        $this->dex             = rand(101, 130);
        $this->int             = rand(116, 140);
        $this->maxhits         = rand(88, 108);
        $this->hits            = $this->maxhits;
        $this->damage          = 4;
        $this->damageMax       = 10;
        $this->resist_physical = rand(40, 55);
        $this->resist_fire     = rand(10, 20);
        $this->resist_cold     = rand(10, 20);
        $this->resist_poison   = rand(10, 20);
        $this->resist_energy   = rand(10, 20);
        $this->karma           = -6500;
        $this->fame            = 6500;
        $this->virtualarmor    = 56;
    }
}