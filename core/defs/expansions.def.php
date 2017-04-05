<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

abstract class expansionDefs {
    const EXPANSION_NONE               = clientDefs::CLIENT_NONE;
    const EXPANSION_T2A                = clientDefs::CLIENT_T2A;
    const EXPANSION_UOR                = self::EXPANSION_T2A | clientDefs::CLIENT_UOR;
    const EXPANSION_UOTD               = self::EXPANSION_UOR  | clientDefs::CLIENT_UOTD;
    const EXPANSION_LBR                = self::EXPANSION_UOTD | clientDefs::CLIENT_LBR;
    const EXPANSION_AOS                = self::EXPANSION_LBR  | clientDefs::CLIENT_AOS | clientDefs::CLIENT_LIVEACCOUNT;
    const EXPANSION_SE                 = self::EXPANSION_AOS  | clientDefs::CLIENT_SE;
    const EXPANSION_ML                 = self::EXPANSION_SE   | clientDefs::CLIENT_ML  | clientDefs::CLIENT_NINTHAGE;
    const EXPANSION_SA                 = self::EXPANSION_ML   | clientDefs::CLIENT_SA  | clientDefs::CLIENT_GOTHIC | clientDefs::CLIENT_RUSTIC;
    const EXPANSION_HS                 = self::EXPANSION_SA   | clientDefs::CLIENT_HS;
    const EXPANSION_TOL                = self::EXPANSION_HS   | clientDefs::CLIENT_TOL | clientDefs::CLIENT_JUNGLE | clientDefs::CLIENT_SHADOWGUARD;
}