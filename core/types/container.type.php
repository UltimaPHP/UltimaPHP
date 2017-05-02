<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TypeContainer extends Object {
    /* carry properties */
    public $maxCarryCapacity;
    public $actualCarry;
    /* Weight properties */
    public $maxWeightCapacity;
    public $actualWeight;
    /* Inside objects */
    public $objects = [];

    public function typeStart() {
        $this->actualCarry  = 0;
        $this->actualWeight = 0;

        $this->equiped = false;
        $this->layer   = LayersDefs::BACKPACK;
    }
}