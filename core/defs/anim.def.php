<?php

abstract class animDefs {
    const ANIM_WALK_UNARM        = 0x00;
    const ANIM_WALK_ARM          = 0x01;
    const ANIM_RUN_UNARM         = 0x02;
    const ANIM_RUN_ARMED         = 0x03;
    const ANIM_STAND             = 0x04;
    const ANIM_FIDGET1           = 0x05;
    const ANIM_FIDGET_YAWN       = 0x06;
    const ANIM_STAND_WAR_1H      = 0x07;
    const ANIM_STAND_WAR_2H      = 0x08;
    const ANIM_ATTACK_1H_WIDE    = 0x09;
    const ANIM_ATTACK_1H_JAB     = 0x0a;
    const ANIM_ATTACK_1H_DOWN    = 0x0b;
    const ANIM_ATTACK_2H_DOWN    = 0x0c;
    const ANIM_ATTACK_2H_WIDE    = 0x0d;
    const ANIM_ATTACK_2H_JAB     = 0x0e;
    const ANIM_WALK_WAR          = 0x0f;
    const ANIM_CAST_DIR          = 0x10;
    const ANIM_CAST_AREA         = 0x11;
    const ANIM_ATTACK_BOW        = 0x12;
    const ANIM_ATTACK_XBOW       = 0x13;
    const ANIM_GET_HIT           = 0x14;
    const ANIM_DIE_BACK          = 0x15;
    const ANIM_DIE_FORWARD       = 0x16;
    const ANIM_BLOCK             = 0x1e;
    const ANIM_ATTACK_UNARM      = 0x1f;
    const ANIM_BOW               = 0x20;
    const ANIM_SALUTE            = 0x21;
    const ANIM_EAT               = 0x22;
    const ANIM_HORSE_RIDE_SLOW   = 0x17;
    const ANIM_HORSE_RIDE_FAST   = 0x18;
    const ANIM_HORSE_STAND       = 0x19;
    const ANIM_HORSE_ATTACK      = 0x1a;
    const ANIM_HORSE_ATTACK_BOW  = 0x1b;
    const ANIM_HORSE_ATTACK_XBOW = 0x1c;
    const ANIM_HORSE_SLAP        = 0x1d;

    // These const ANIMations are used by const ANIMals
    // const ANIMals. (Most All const ANIMals have all const ANIMs)
    const ANIM_ANI_WALK    = 0x00;
    const ANIM_ANI_RUN     = 0x01;
    const ANIM_ANI_STAND   = 0x02;
    const ANIM_ANI_EAT     = 0x03;
    const ANIM_ANI_ALERT   = 0x04;
    const ANIM_ANI_ATTACK1 = 0x05;
    const ANIM_ANI_ATTACK2 = 0x06;
    const ANIM_ANI_GETHIT  = 0x07;
    const ANIM_ANI_DIE1    = 0x08;
    const ANIM_ANI_FIDGET1 = 0x09;
    const ANIM_ANI_FIDGET2 = 0x0a;
    const ANIM_ANI_SLEEP   = 0x0b;
    const ANIM_ANI_DIE2    = 0x0c;
}