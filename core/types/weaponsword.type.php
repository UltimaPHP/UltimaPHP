<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TypeWeaponSword extends UObject {
    public function typeStart() {
        $this->equiped = false;
        $this->layer   = ($this->twohands ? LayersDefs::HAND_TWO : LayersDefs::HAND_ONE);
    }
}