<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

abstract class clientDefs {
    const CLIENT_NONE                 = 0x00000000;
    const CLIENT_T2A                  = 0x00000001;
    const CLIENT_UOR                  = 0x00000002;
    const CLIENT_UOTD                 = 0x00000004;
    const CLIENT_LBR                  = 0x00000008;
    const CLIENT_AOS                  = 0x00000010;
    const CLIENT_SIXTHCHARACTERSLOT   = 0x00000020;
    const CLIENT_SE                   = 0x00000040;
    const CLIENT_ML                   = 0x00000080;
    const CLIENT_EIGTHAGE             = 0x00000100;
    const CLIENT_NINTHAGE             = 0x00000200; /* CRYSTAL/SHADOW CUSTOM HOUSE TILES */
    const CLIENT_TENTHAGE             = 0x00000400;
    const CLIENT_INCREASEDSTORAGE     = 0x00000800; /* INCREASED HOUSING/BANK STORAGE */
    const CLIENT_SEVENTHCHARACTERSLOT = 0x00001000;
    const CLIENT_ROLEPLAYFACES        = 0x00002000;
    const CLIENT_TRIALACCOUNT         = 0x00004000;
    const CLIENT_LIVEACCOUNT          = 0x00008000;
    const CLIENT_SA                   = 0x00010000;
    const CLIENT_HS                   = 0x00020000;
    const CLIENT_GOTHIC               = 0x00040000;
    const CLIENT_RUSTIC               = 0x00080000;
    const CLIENT_JUNGLE               = 0x00100000;
    const CLIENT_SHADOWGUARD          = 0x00200000;
    const CLIENT_TOL                  = 0x00400000;
}