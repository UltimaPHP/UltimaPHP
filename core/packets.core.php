<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Packets {

    /**version
     * Packet list with the packet length
     * Note: Dynamic length packets are marked with -1 this way the server looks on the packet for the right length
     * Note: Packets with no "length" are marked as false, this way the server treat the entire received packet as one single packet.
     */
    static $packets = [0x00 => 0x0068, 0x01 => 0x0005, 0x02 => 0x0007, 0x03 => false, 0x04 => 0x0002, 0x05 => 0x0005, 0x06 => 0x0005, 0x07 => 0x0007, 0x08 => 0x000E, 0x09 => 0x0005, 0x0A => 0x000B, 0x0B => 0x010A, 0x0C => false, 0x0D => 0x0003, 0x0E => false, 0x0F => 0x003D, 0x10 => 0x00D7, 0x11 => false, 0x12 => false, 0x13 => 0x000A, 0x14 => 0x0006, 0x15 => 0x0009, 0x16 => 0x0001, 0x17 => false, 0x18 => false, 0x19 => false, 0x1A => false, 0x1B => 0x0025, 0x1C => false, 0x1D => 0x0005, 0x1E => 0x0004, 0x1F => 0x0008, 0x20 => 0x0013, 0x21 => 0x0008, 0x22 => 0x0003, 0x23 => 0x001A, 0x24 => 0x0007, 0x25 => 0x0014, 0x26 => 0x0005, 0x27 => 0x0002, 0x28 => 0x0005, 0x29 => 0x0001, 0x2A => 0x0005, 0x2B => 0x0002, 0x2C => 0x0002, 0x2D => 0x0011, 0x2E => 0x000F, 0x2F => 0x000A, 0x30 => 0x0005, 0x31 => 0x0001, 0x32 => 0x0002, 0x33 => 0x0002, 0x34 => 0x000A, 0x35 => 0x028D, 0x36 => false, 0x37 => 0x0008, 0x38 => 0x0007, 0x39 => 0x0009, 0x3A => false, 0x3B => false, 0x3C => false, 0x3D => 0x0002, 0x3E => 0x0025, 0x3F => false, 0x40 => 0x00C9, 0x41 => false, 0x42 => false, 0x43 => 0x0229, 0x44 => 0x02C9, 0x45 => 0x0005, 0x46 => false, 0x47 => 0x000B, 0x48 => 0x0049, 0x49 => 0x005D, 0x4A => 0x0005, 0x4B => 0x0009, 0x4C => false, 0x4D => false, 0x4E => 0x0006, 0x4F => 0x0002, 0x50 => false, 0x51 => false, 0x52 => false, 0x53 => 0x0002, 0x54 => 0x000C, 0x55 => 0x0001, 0x56 => 0x000B, 0x57 => 0x006E, 0x58 => 0x006A, 0x59 => false, 0x5A => false, 0x5B => 0x0004, 0x5C => 0x0002, 0x5D => 0x0049, 0x5E => false, 0x5F => 0x0031, 0x60 => 0x0005, 0x61 => 0x0009, 0x62 => 0x000F, 0x63 => 0x000D, 0x64 => 0x0001, 0x65 => 0x0004, 0x66 => false, 0x67 => 0x0015, 0x68 => false, 0x69 => false, 0x6A => 0x0003, 0x6B => 0x0009, 0x6C => 0x0013, 0x6D => 0x0003, 0x6E => 0x000E, 0x6F => false, 0x70 => 0x001C, 0x71 => false, 0x72 => 0x0005, 0x73 => 0x0002, 0x74 => false, 0x75 => 0x0023, 0x76 => 0x0010, 0x77 => 0x0011, 0x78 => false, 0x79 => 0x0009, 0x7A => false, 0x7B => 0x0002, 0x7C => false, 0x7D => 0x000D, 0x7E => 0x0002, 0x7F => false, 0x80 => 0x003E, 0x81 => false, 0x82 => 0x0002, 0x83 => 0x0027, 0x84 => 0x0045, 0x85 => 0x0002, 0x86 => false, 0x87 => false, 0x88 => 0x0042, 0x89 => false, 0x8A => false, 0x8B => false, 0x8C => 0x000B, 0x8D => false, 0x8E => false, 0x8F => false, 0x90 => 0x0013, 0x91 => 0x0041, 0x92 => false, 0x93 => 0x0063, 0x94 => false, 0x95 => 0x0009, 0x96 => false, 0x97 => 0x0002, 0x98 => false, 0x99 => 0x001A, 0x9A => false, 0x9B => 0x0102, 0x9C => 0x0135, 0x9D => 0x0033, 0x9E => false, 0x9F => false, 0xA0 => 0x0003, 0xA1 => 0x0009, 0xA2 => 0x0009, 0xA3 => 0x0009, 0xA4 => 0x0095, 0xA5 => false, 0xA6 => false, 0xA7 => 0x0004, 0xA8 => false, 0xA9 => false, 0xAA => 0x0005, 0xAB => false, 0xAC => false, 0xAD => false, 0xAE => false, 0xAF => 0x000D, 0xB0 => false, 0xB1 => false, 0xB2 => false, 0xB3 => false, 0xB4 => false, 0xB5 => 0x0040, 0xB6 => 0x0009, 0xB7 => false, 0xB8 => false, 0xB9 => 0x0003, 0xBA => 0x0006, 0xBB => 0x0009, 0xBC => 0x0003, 0xBD => -1, 0xBE => false, 0xBF => -1, 0xC0 => 0x0024, 0xC1 => false, 0xC2 => false, 0xC3 => false, 0xC4 => 0x0006, 0xC5 => 0x00CB, 0xC6 => 0x0001, 0xC7 => 0x0031, 0xC8 => 0x0002, 0xC9 => 0x0006, 0xCA => 0x0006, 0xCB => 0x0007, 0xCC => false, 0xCD => 0x0001, 0xCE => false, 0xCF => 0x004E, 0xD0 => false, 0xD1 => 0x0002, 0xD2 => 0x0019, 0xD3 => false, 0xD4 => false, 0xD5 => false, 0xD6 => false, 0xD7 => false, 0xD8 => false, 0xD9 => 0x010C, 0xDA => false, 0xDB => false, 0xDC => 9, 0xDD => 1, 0xDE => 1, 0xDF => 1, 0xE0 => 1, 0xE1 => 9, 0xE2 => 10, 0xE3 => 77, 0xEC => 1, 0xED => 1, 0xEF => 21, 0xF0 => 1, 0xF1 => 1, 0xF3 => 24, 0xF5 => 21, 0xF8 => 106];
    /*
     * Strange package received from client in the login proccess...
     */

    public static function packet_0x1($data, $client) {
        if (count($data) >= 68) {
            $major     = hexdec($data[0]);
            $minor     = hexdec($data[1]);
            $revision  = hexdec($data[2]);
            $prototype = hexdec($data[3]);

            UltimaPHP::$socketClients[$client]['version'] = array(
                'major'     => $major,
                'minor'     => $minor,
                'revision'  => $revision,
                'prototype' => $prototype,
            );

            self::packet_0x91(array_slice($data, 4), $client, true);
        }
    }

    /**
     * Packet received when the player try to walk/move
     *
     * Directions:
     *     0x00 - North
     *     0x01 - Northeast
     *     0x02 - East
     *     0x03 - Southeast
     *     0x04 - South
     *     0x05 - Southwest
     *     0x06 - West
     *     0x07 - Northwest
     */
    public static function packet_0x02($data, $client) {
        $command             = Functions::strToHex(Functions::hexToChr($data, 0, 0, true));
        $direction           = Functions::strToHex(Functions::hexToChr($data, 1, 1, true));
        $sequence_number     = Functions::strToHex(Functions::hexToChr($data, 2, 2, true));
        $fastwalk_prevention = Functions::strToHex(Functions::hexToChr($data, 3, 6, true));

        UltimaPHP::$socketClients[$client]['account']->player->movePlayer(false, $direction, $sequence_number, $fastwalk_prevention);
    }

    /**
     * Packet received when client triggers a DClick
     */
    public static function packet_0x06($data, $client) {
        $command = $data[0];
        $uid     = $data[1] . $data[2] . $data[3] . $data[4];

        $player = UltimaPHP::$socketClients[$client]['account']->player;
        $player->dclick($uid);
        // UltimaPHP::log("Character " . $player->name . " double clicked on UID '$uid'");
    }

    /**
     *     Packet received when player tryies to pick up item
     */
    public static function packet_0x07($data, $client) {
        $command     = $data[0];
        $item_serial = $data[1] . $data[2] . $data[3] . $data[4];
        $amount      = hexdec($data[5] . $data[6]);

        // What to do now?
        // $player = UltimaPHP::$socketClients[$client]['account']->player;
        // $player->pickUp($item_serial, $amount);
    }

    /**
     * Packet received when player tryies to click on object
     */
    public static function packet_0x09($data, $client) {
        $command = $data[0];
        $object  = $data[1] . $data[2] . $data[3] . $data[4];

        UltimaPHP::$socketClients[$client]['account']->player->click($object);
    }

    /*
     * Packet received from GOD client to fix map Z
     */
    public static function packet_0x14($data, $client) {}

    /**
     * Packet received from client asking for status information
     *
     * Types:
     * 0x00 = God Client
     * 0x04 = Basic Status
     * 0x05 = Request Skills
     *
     */
    public static function packet_0x34($data, $client) {
        $command = $data[0];
        $unknow  = $data[1] . $data[2] . $data[3] . $data[4];
        $type    = $data[5];
        $serial  = array(
            $data[6],
            $data[7],
            $data[8],
            $data[9],
        );

        switch ($type) {
        case 0x00:

            // God client ???
            break;

        case 0x04:
            // Client asking to server send the status information to the client
            UltimaPHP::$socketClients[$client]['account']->player->statusBarInfo(false);
            break;

        case 0x05:
            UltimaPHP::$socketClients[$client]['account']->player->sendFullSkillList(false);
            // Client asking to server send the skills information to the client
            break;

        default:

            // Unknow status type received
            break;
        }
    }

    /**
     * Packet received after client choose a character
     */
    public static function packet_0x5D($data, $client) {
        $command      = $data[0];
        $charname     = Functions::hexToChr($data, 5, 34, true);
        $clientflag   = Functions::hexToChr($data, 37, 40, true);
        $loginaccount = Functions::hexToChr($data, 45, 48, true);
        $slotchoosen  = hexdec($data[65] . $data[66] . $data[67] . $data[68]);
        $clientIP     = hexdec($data[69]) . "." . hexdec($data[70]) . "." . hexdec($data[71]) . "." . hexdec($data[72]);

        UltimaPHP::$socketClients[$client]['account']->loginCharacter($slotchoosen);
    }

    /**
     * Packet received when client changes war/peace mode
     */
    public static function packet_0x72($data, $client) {
        $command = $data[0];
        $flag    = $data[1];
        $unknow  = $data[2] . $data[3] . $data[4];

        UltimaPHP::$socketClients[$client]['account']->player->setWarMode(false, $flag);
    }

    /**
     * Send ping response to the client
     */
    public static function packet_0x73($data, $client) {
        if (isset(UltimaPHP::$socketClients[$client]['account'])) {
            UltimaPHP::$socketClients[$client]['account']->sendPingResponse();
        } else {
            socket_close(UltimaPHP::$socketClients[$client]['socket']);
            unset(UltimaPHP::$socketClients[$client]);
        }
    }

    /**
     * Receive login request from client
     */
    public static function packet_0x80($data, $client) {
        $command  = $data[0];
        $account  = Functions::hexToChr($data, 1, 30, true);
        $password = Functions::hexToChr($data, 31, 61, true);

        $login = false;

        // Account / Password validadion TODO
        UltimaPHP::$socketClients[$client]['account'] = array(
            'account'  => $account,
            'password' => md5($password),
        );
        UltimaPHP::$socketClients[$client]['account'] = new Account($account, md5($password), $client);

        if (true === UltimaPHP::$socketClients[$client]['account']->isValid) {
            UltimaPHP::log("Account $account connected from " . UltimaPHP::$socketClients[$client]['ip']);

            // Send to the client an client version request
            //UltimaPHP::$socketClients[$client]['account']->sendClientVersionRequest();

            // Send to the client the server list
            UltimaPHP::$socketClients[$client]['account']->sendServerList();
        } else {
            UltimaPHP::$socketClients[$client]['account']->disconnect(3);
        }
    }

    /**
     * Send to the client the features from server
     */
    public static function packet_0x91($data, $client, $redirected = false) {
        $command  = $data[0];
        $keyUsed  = hexdec($data[1]) . hexdec($data[2]) . hexdec($data[3]) . hexdec($data[4]);
        $account  = Functions::hexToChr($data, 5, 34, true);
        $password = Functions::hexToChr($data, 35, 64, true);
		
        $login = false;

        UltimaPHP::$socketClients[$client]['account'] = new Account($account, md5($password), $client);

        if (true === UltimaPHP::$socketClients[$client]['account']->isValid) {
        	
            UltimaPHP::log("Account $account logged from IP " . UltimaPHP::$socketClients[$client]['ip']);

            // Set the flag on the connection to send next packets compressed
            UltimaPHP::$socketClients[$client]['compressed'] = true;
			
            UltimaPHP::$socketClients[$client]['account']->enableLockedFeatures();
            UltimaPHP::$socketClients[$client]['account']->sendCharacterList();
        } else {
            UltimaPHP::$socketClients[$client]['account']->disconnect(3);
        }
    }

    /**
     * Receive the selected server from client
     */
    public static function packet_0xA0($data, $client) {
        $server                                                = dechex($data[1] . $data[2]);
        UltimaPHP::$socketClients[$client]['connected_server'] = ((int) $server - 1);
        UltimaPHP::log("Account " . UltimaPHP::$socketClients[$client]['account']->account . " connecting on server " . UltimaPHP::$servers[UltimaPHP::$socketClients[$client]['connected_server']]['name']);
        UltimaPHP::$socketClients[$client]['account']->sendConnectionConfirmation();
    }

    /**
     * Receive the CharCreator 0x00 -  Old Clients < 7.0.16
     */
    public static function packet_0x00($data, $client) {
    	$command = $data[0];        
        $size    = hexdec(Functions::implodeByte($data, 1, 2));
        $type    = $data[3];
		$serial  = hexdec(Functions::implodeByte($data, 4, 7));
		$unknown = hexdec(Functions::implodeByte($data, 8, 9));
		$textLength = hexdec(Functions::implodeByte($data, 10, 11));
		$text = Functions::hexToChr($data, 12, ($textLength*2));

		echo $size."\n".$type."\n".$serial."\n".$unknown."\n".$textLength."\n".$text;
    }
    
    /**
     * Receive Profile Request
     */
    public static function packet_0xB8($data, $client) {
        if (true === UltimaPHP::$conf['logs']['debug']) {
            echo "A implementar!";
        }
    }
    
    /**
     * Sending New Map Details Packet < 7.0.16
     */
    public static function packet_0xF5($data, $client) {
        if (true === UltimaPHP::$conf['logs']['debug']) {
            echo "OLHA AQUIIIII";
        }
    }


    /**
     * Receive the CharCreator 0xF8 -  New Clients >= 7.0.16
     */
    public static function packet_0xF8($data, $client) {
        $command     = $data[0];
        $unknown1    = hexdec(Functions::implodeByte($data, 1, 4));
        $unknown2    = hexdec(Functions::implodeByte($data, 5, 8));
        $unknown3    = hexdec($data[9]);
        $charName    = Functions::hexToChr($data, 10, 39);
        $unknown4    = hexdec(Functions::implodeByte($data, 40, 41));
        $flags       = hexdec(Functions::implodeByte($data, 42, 45));
        $unknown5    = hexdec(Functions::implodeByte($data, 46, 49));
        $loginCount  = hexdec(Functions::implodeByte($data, 50, 53));
        $profession  = hexdec($data[54]);
        $unknown6    = hexdec(Functions::implodeByte($data, 55, 69));
        $genderRace  = hexdec($data[70]);
        $str         = hexdec($data[71]);
        $dex         = hexdec($data[72]);
        $int         = hexdec($data[73]);
        $skillid1    = hexdec($data[74]);
        $skillvalue1 = hexdec($data[75]);
        $skillid2    = hexdec($data[76]);
        $skillvalue2 = hexdec($data[77]);
        $skillid3    = hexdec($data[78]);
        $skillvalue3 = hexdec($data[79]);
        $skillid4    = hexdec($data[80]);
        $skillvalue4 = hexdec($data[81]);
        $skinColor   = hexdec(Functions::implodeByte($data, 82, 83));
        $hairStyle   = hexdec(Functions::implodeByte($data, 84, 85));
        $hairColor   = hexdec(Functions::implodeByte($data, 86, 87));
        $beardStyle  = hexdec(Functions::implodeByte($data, 88, 89));
        $beardColor  = hexdec(Functions::implodeByte($data, 90, 91));
        $shardIndex  = hexdec($data[92]);
        $startCity   = hexdec($data[93]);
        $charSlot    = hexdec(Functions::implodeByte($data, 94, 97));
        $clientIp     = hexdec($data[98]) . "." . hexdec($data[99]) . "." . hexdec($data[100]) . "." . hexdec($data[101]);
        $shirtColor  = hexdec(Functions::implodeByte($data, 102, 103));
        $pantsColor  = hexdec(Functions::implodeByte($data, 104, 105));

        switch ($profession) {
            case 1: // Warrior
                $skillid1    = skillsDefs::SKILL_SWORDSMANSHIP;
                $skillvalue1 = 30;
                $skillid2    = skillsDefs::SKILL_TACTICS;
                $skillvalue2 = 50;
                $skillid3    = skillsDefs::SKILL_HEALING;
                $skillvalue3 = 45;
                $skillid4    = skillsDefs::SKILL_ANATOMY;
                $skillvalue4 = 30;
                $professionTitle = "Warrior";
                break;
            case 2:
                $skillid1    = skillsDefs::SKILL_EVALINT;
                $skillvalue1 = 30;
                $skillid2    = skillsDefs::SKILL_WRESTLING;
                $skillvalue2 = 30;
                $skillid3    = skillsDefs::SKILL_MAGERY;
                $skillvalue3 = 50;
                $skillid4    = skillsDefs::SKILL_MEDITATION;
                $skillvalue4 = 50;
                $professionTitle = "Mage";
                break;
            case 3:
                $skillid1    = skillsDefs::SKILL_MINING;
                $skillvalue1 = 30;
                $skillid2    = skillsDefs::SKILL_ARMSLORE;
                $skillvalue2 = 30;
                $skillid3    = skillsDefs::SKILL_BLACKSMITH;
                $skillvalue3 = 50;
                $skillid4    = skillsDefs::SKILL_TINKERING;
                $skillvalue4 = 50;
                $professionTitle = "Blacksmith";
                break;
            case 4:
                $skillid1    = skillsDefs::SKILL_NECROMANCY;
                $skillvalue1 = 50;
                $skillid2    = skillsDefs::SKILL_FOCUS;
                $skillvalue2 = 30;
                $skillid3    = skillsDefs::SKILL_SPIRITSPEAK;
                $skillvalue3 = 30;
                $skillid4    = skillsDefs::SKILL_SWORDSMANSHIP;
                $skillvalue4 = 30;
                $professionTitle = "Necromancer";
                break;
            case 5:
                $skillid1    = skillsDefs::SKILL_CHIVALRY;
                $skillvalue1 = 51;
                $skillid2    = skillsDefs::SKILL_SWORDSMANSHIP;
                $skillvalue2 = 49;
                $skillid3    = skillsDefs::SKILL_FOCUS;
                $skillvalue3 = 30;
                $skillid4    = skillsDefs::SKILL_TACTICS;
                $skillvalue4 = 30;
                $professionTitle = "Paladin";
                break;
            case 6:
                $skillid1    = skillsDefs::SKILL_BUSHIDO;
                $skillvalue1 = 50;
                $skillid2    = skillsDefs::SKILL_SWORDSMANSHIP;
                $skillvalue2 = 50;
                $skillid3    = skillsDefs::SKILL_ANATOMY;
                $skillvalue3 = 30;
                $skillid4    = skillsDefs::SKILL_HEALING;
                $skillvalue4 = 30;
                $professionTitle = "Samurai";
                break;
            case 7: // Ninja
                $skillid1    = skillsDefs::SKILL_NINJITSU;
                $skillvalue1 = 50;
                $skillid2    = skillsDefs::SKILL_HIDING;
                $skillvalue2 = 50;
                $skillid3    = skillsDefs::SKILL_FENCING;
                $skillvalue3 = 30;
                $skillid4    = skillsDefs::SKILL_STEALTH;
                $skillvalue4 = 30;
                $professionTitle = "Ninja";
                break;
            default:
                $professionTitle = "Adventurer";
                break;
        }

        $gender = ($genderRace % 2); // 0 = male && 1 = female
        $race = ($genderRace <= 3 ? 0 : ($genderRace > 3 && $genderRace < 6 ? 1 : 2));
        $body = ($genderRace <= 3 ? ($gender ? 401 : 400) : ($genderRace > 3 && $genderRace < 6 ? ($gender ? 606 : 605) : ($gender ? 667 : 666)));

        $newChar = [
            'name' => $charName,
            'flags' => $flags,
            'profession' => $profession,
            'title' => $professionTitle,
            'sex' => $gender,
            'race' => $race,
            'body' => $body,
            'color' => [
                'skin' => $skinColor,
                'pants' => $pantsColor,
                'shirt' => $shirtColor
            ],
            'hair' => [
                'style' => $hairStyle,
                'color' => $hairColor,
            ],
            'beard' => [
                'style' => $beardStyle,
                'color' => $beardColor,
            ],
            'stats' => [
                'str' => $str,
                'dex' => $dex,
                'int' => $int,
            ],
            'skills' => [
                ['skill' => $skillid1, 'value' => $skillvalue1],
                ['skill' => $skillid2, 'value' => $skillvalue2],
                ['skill' => $skillid3, 'value' => $skillvalue3],
                ['skill' => $skillid4, 'value' => $skillvalue4]
            ],
            'shard' => $shardIndex,
            'slot' => $charSlot,
            'start' => UltimaPHP::$starting_locations[($startCity-1)],
            'ip' => $clientIp
        ];

        UltimaPHP::$socketClients[$client]['account']->createNewChar($newChar, true);
    }

    /**
     * Unicode/Ascii speech request
     */
    public static function packet_0XAD($data, $client) {
        $command  = $data[0];
        $length   = hexdec($data[1] . $data[2]);
        $type     = $data[3];
        $color    = hexdec($data[4] . $data[5]);
        $font     = hexdec($data[6] . $data[7]);
        $language = Functions::hexToChr($data, 8, 11);

        // $types = array(
        //     0x00 => 'Normal ',
        //     0x01 => 'Broadcast/System',
        //     0x02 => 'Emote ',
        //     0x06 => 'System/Lower Corner',
        //     0x07 => 'Message/Corner With Name',
        //     0x08 => 'Whisper',
        //     0x09 => 'Yell',
        //     0x0A => 'Spell',
        //     0x0D => 'Guild Chat',
        //     0x0E => 'Alliance Chat',
        //     0x0F => 'Command Prompts'
        // );
        // Cheks if the type have the 0xc0 mask
        $type_masked = false;
        if (substr($type, 0, 1) == "C") {
            $type = hexdec($type);
            $type &= ~0xC0;
            $type_masked = true;
        }

        $actual_byte = 12;

        $text = "";

        if ($type_masked) {
            $value = hexdec($data[$actual_byte] . $data[($actual_byte + 1)]);
            $actual_byte += 2;
            $count = ($value & 0xFFF0) >> 4;
            $hold  = $value & 0xF;

            if ($count < 0 || $count > 50) {
                return;
            }

            $keywordList = array();

            for ($i = 0; $i < $count; $i++) {
                $speechID;

                if (($i & 1) == 0) {
                    $hold <<= 8;
                    $hold |= hexdec($data[$actual_byte]);
                    $actual_byte++;
                    $speechID = $hold;
                    $hold     = 0;
                } else {
                    $value = hexdec($data[$actual_byte] . $data[($actual_byte + 1)]);
                    $actual_byte += 2;
                    $speechID = ($value & 0xFFF0) >> 4;
                    $hold     = $value & 0xF;
                }

                if (!in_array($speechID, $keywordList)) {
                    $keywordList[] = $speechID;
                }
            }

            $text = Functions::readUnicodeStringSafe(array_slice($data, $actual_byte, -1));
        } else {
            $text = Functions::readUnicodeStringSafe(array_slice($data, $actual_byte, -1));
        }
        UltimaPHP::$socketClients[$client]['account']->player->speech($type, $color, $font, $language, $text);
    }

    /**
     * Open Chat Window (????)
     *
     * This message is very incomplete. From the server, just know that it is 0xB5 len len, and pass the data through as is appropriate.
     */
    public static function packet_0xB5($data, $client) {
        $command  = $data[0];
        $chatname = hexdec(Functions::implodeByte($data, 1, 63));
    }

    /**
     * Receive client version information from the client 6.0.5.0-, newer send packet 0xEF
     */
    public static function packet_0xBD($data, $client) {
        $comand  = $data[0];
        $length  = hexdec($data[1] . $data[2]);
        $version = explode(".", Functions::hexToChr(implode("", array_slice($data, 3))));

        // Fix for versions with glued last char, IE: 4.0.11c
        if (strlen($version[2]) > 2) {
            $version[3] = substr($version[2], 2) . (isset($version[3]) ? $version[3] : "");
            $version[2] = substr($version[2], 0, 2);
        }

        UltimaPHP::$socketClients[$client]['version'] = [
            'major'     => $version[0],
            'minor'     => $version[1],
            'revision'  => $version[2],
            'prototype' => $version[3],
        ];
    }

    /**
     * Send/Request general information
     */
    public static function packet_0xBF($data, $client) {
        $comand    = $data[0];
        $length    = hexdec($data[1] . $data[2]);
        $subcomand = hexdec($data[3] . $data[4]);

        switch ($subcomand) {
        case 5:

            // Screen Size
            $unknow1 = Functions::hexToChr($data, 5, 6, true);
            $x       = Functions::hexToChr($data, 7, 8, true);
            $y       = Functions::hexToChr($data, 9, 10, true);
            $unknow2 = Functions::hexToChr($data, 11, 12, true);
            break;

        case 11:

            // Client language
            $language                                      = Functions::hexToChr($data, 5, 8);
            UltimaPHP::$socketClients[$client]['language'] = $language;
            break;

        case 15:

            // ClientType
            $unk1                                      = hexdec($data[5]);
            $ClientType                                = Functions::hexToChr($data, 6, 9);
            UltimaPHP::$socketClients[$client]['type'] = $ClientType;
            break;
        }
    }

    public static function packet_0xC8($data, $client) {
        $command                                                          = $data[0];
        $range                                                            = hexdec($data[1]);
        UltimaPHP::$socketClients[$client]['account']->player->view_range = ($range > 18 ? 18 : $range);
    }

    /**
     * Spy on client
     */
    public static function packet_0xD9($data, $client) {

    }

    /**
     * Receive client version information from client version 6.0.5.0+
     */
    public static function packet_0xEF($data, $client) {
        if (count($data) < 21) {
            UltimaPHP::$socketClients[$client]['account']->disconnect(4);
            return;
        }

        $command   = $data[0];
        $seed      = hexdec(Functions::implodeByte($data, 1, 4));
        $major     = hexdec(Functions::implodeByte($data, 5, 8));
        $minor     = hexdec(Functions::implodeByte($data, 9, 12));
        $revision  = hexdec(Functions::implodeByte($data, 13, 16));
        $prototype = hexdec(Functions::implodeByte($data, 17, 20));

        UltimaPHP::$socketClients[$client]['version'] = array(
            'major'     => $major,
            'minor'     => $minor,
            'revision'  => $revision,
            'prototype' => $prototype,
        );
    }

}

?>