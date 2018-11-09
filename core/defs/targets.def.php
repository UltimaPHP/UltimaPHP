<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

abstract class TargetDefs {
    const OBJECT = 0x00;
    const LAND   = 0x01;
}

abstract class TargetFlagsDefs {
    const None = 0x00;
    const Harmful   = 0x01;
    const Beneficial   = 0x02;
    const CancelTarget   = 0x03;
}
