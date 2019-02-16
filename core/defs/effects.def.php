<?php

abstract class HuedEffectType {
    const FROM_SOURCE_TO_DEST    = 0x00;
    const LIGHTNING_STRIKE = 0x01;
    const STAY_WITH_DESTINATION = 0x02;
    const STAY_WITH_SOURCE     = 0x03;
}

abstract class EffectLayer {
    const HEAD = 0;
    const RightHand = 1;
    const LeftHand = 2;
    const Waist = 3;
    const LeftFoot = 4;
    const RightFoot = 5;
    const CenterFeet = 7;
}

abstract class ParticleSupportType {
    const FULL = 0;
    const DETECT = 1;
    const NONE = 2;
}