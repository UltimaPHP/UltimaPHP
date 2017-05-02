<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

abstract class LayersDefs {
    const INVALID      = 0x00;
    const HAND_ONE     = 0x01;
    const HAND_TWO     = 0x02;
    const SHOES        = 0x03;
    const PANTS        = 0x04;
    const SHIRT        = 0x05;
    const HELM         = 0x06;
    const GLOVES       = 0x07;
    const RING         = 0x08;
    const TALISMAN     = 0x09;
    const NECK         = 0x0A;
    const HAIR         = 0x0B;
    const WAIST        = 0x0C;
    const INNER_TORSO  = 0x0D;
    const BRACELET     = 0x0E;
    const FACE         = 0x0F;
    const FACIAL_HAIR  = 0x10;
    const MIDDLE_TORSO = 0x11;
    const EAR_RINGS    = 0x12;
    const ARMS         = 0x13;
    const CLOAK        = 0x14;
    const BACKPACK     = 0x15;
    const OUTER_TORSO  = 0x16;
    const OUTER_LEGS   = 0x17;
    const INNER_LEGS   = 0x18;
    const MOUNT        = 0x19;
    const SHOP_BUY     = 0x1A;
    const SHOP_RESALE  = 0x1B;
    const SHOP_SELL    = 0x1C;
    const BANK         = 0x1D;
    /* Other layers */
    const SPECIAL      = 0x1E; // Can have multiple objects
    const DRAGGING     = 0x1F;
}