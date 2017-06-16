<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

abstract class TiledataDefs {
    const NONE        = 0x00000000;
    const BACKGROUND  = 0x00000001;
    const WEAPON      = 0x00000002;
    const TRANSPARENT = 0x00000004;
    const TRANSLUCENT = 0x00000008;
    const WALL        = 0x00000010;
    const DAMAGING    = 0x00000020;
    const IMPASSABLE  = 0x00000040;
    const WET         = 0x00000080;
    const UNKNOWN1    = 0x00000100;
    const SURFACE     = 0x00000200;
    const BRIDGE      = 0x00000400;
    const GENERIC     = 0x00000800;
    const WINDOW      = 0x00001000;
    const NOSHOOT     = 0x00002000;
    const ARTICLEA    = 0x00004000;
    const ARTICLEAN   = 0x00008000;
    const INTERNAL    = 0x00010000;
    const FOLIAGE     = 0x00020000;
    const PARTIALHUE  = 0x00040000;
    const UNKNOWN2    = 0x00080000;
    const MAP         = 0x00100000;
    const CONTAINER   = 0x00200000;
    const WEARABLE    = 0x00400000;
    const LIGHTSOURCE = 0x00800000;
    const ANIMATION   = 0x01000000;
    const NODIAGONAL  = 0x02000000;
    const UNKNOWN3    = 0x04000000;
    const ARMOR       = 0x08000000;
    const ROOF        = 0x10000000;
    const DOOR        = 0x20000000;
    const STAIRBACK   = 0x40000000;
    const STAIRRIGHT  = 0x80000000;
}