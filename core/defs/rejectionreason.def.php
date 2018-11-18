<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

abstract class RejectionReason {
    const INVALID   = 0x00;
    const ACCOUNT_IN_USE = 0x01;
    const ACCOUNT_BLOCKED = 0x02;
    const WRONG_PASSWORD = 0x03;
    const COMMUNICATION_PROBLEM = 0x04;
    const IGR = 0x06;
    const CHARACTER_TRANSFER = 0x09;
    const TIME_OUT = 0xFE;
    const BAD_COMMUNICATION = 0xFF;
   
}