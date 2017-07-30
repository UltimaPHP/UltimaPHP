<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0xF8 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0xF8);

        if ($client) {
            $this->client = $client;
        }
    }

    /**
     * Handle the packet receive
     */
    public function receive($data) {
        if (!$this->client) {
            return false;
        }

        $command     = $data[0];
        $unknown1    = hexdec(Functions::implodeByte($data, 1, 4));
        $unknown2    = hexdec(Functions::implodeByte($data, 5, 8));
        $unknown3    = hexdec($data[9]);
        $charName    = Functions::readUnicodeStringSafe(str_split(Functions::implodeByte($data, 10, 39), 2));
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
        $clientIp    = hexdec($data[98]) . "." . hexdec($data[99]) . "." . hexdec($data[100]) . "." . hexdec($data[101]);
        $shirtColor  = hexdec(Functions::implodeByte($data, 102, 103));
        $pantsColor  = hexdec(Functions::implodeByte($data, 104, 105));

        switch ($profession) {
	        case 1: // Warrior
	            $skillid1        = skillsDefs::SKILL_SWORDSMANSHIP;
	            $skillvalue1     = 30;
	            $skillid2        = skillsDefs::SKILL_TACTICS;
	            $skillvalue2     = 50;
	            $skillid3        = skillsDefs::SKILL_HEALING;
	            $skillvalue3     = 45;
	            $skillid4        = skillsDefs::SKILL_ANATOMY;
	            $skillvalue4     = 30;
	            $professionTitle = "Warrior";
	            break;
	        case 2:
	            $skillid1        = skillsDefs::SKILL_EVALINT;
	            $skillvalue1     = 30;
	            $skillid2        = skillsDefs::SKILL_WRESTLING;
	            $skillvalue2     = 30;
	            $skillid3        = skillsDefs::SKILL_MAGERY;
	            $skillvalue3     = 50;
	            $skillid4        = skillsDefs::SKILL_MEDITATION;
	            $skillvalue4     = 50;
	            $professionTitle = "Mage";
	            break;
	        case 3:
	            $skillid1        = skillsDefs::SKILL_MINING;
	            $skillvalue1     = 30;
	            $skillid2        = skillsDefs::SKILL_ARMSLORE;
	            $skillvalue2     = 30;
	            $skillid3        = skillsDefs::SKILL_BLACKSMITH;
	            $skillvalue3     = 50;
	            $skillid4        = skillsDefs::SKILL_TINKERING;
	            $skillvalue4     = 50;
	            $professionTitle = "Blacksmith";
	            break;
	        case 4:
	            $skillid1        = skillsDefs::SKILL_NECROMANCY;
	            $skillvalue1     = 50;
	            $skillid2        = skillsDefs::SKILL_FOCUS;
	            $skillvalue2     = 30;
	            $skillid3        = skillsDefs::SKILL_SPIRITSPEAK;
	            $skillvalue3     = 30;
	            $skillid4        = skillsDefs::SKILL_SWORDSMANSHIP;
	            $skillvalue4     = 30;
	            $professionTitle = "Necromancer";
	            break;
	        case 5:
	            $skillid1        = skillsDefs::SKILL_CHIVALRY;
	            $skillvalue1     = 51;
	            $skillid2        = skillsDefs::SKILL_SWORDSMANSHIP;
	            $skillvalue2     = 49;
	            $skillid3        = skillsDefs::SKILL_FOCUS;
	            $skillvalue3     = 30;
	            $skillid4        = skillsDefs::SKILL_TACTICS;
	            $skillvalue4     = 30;
	            $professionTitle = "Paladin";
	            break;
	        case 6:
	            $skillid1        = skillsDefs::SKILL_BUSHIDO;
	            $skillvalue1     = 50;
	            $skillid2        = skillsDefs::SKILL_SWORDSMANSHIP;
	            $skillvalue2     = 50;
	            $skillid3        = skillsDefs::SKILL_ANATOMY;
	            $skillvalue3     = 30;
	            $skillid4        = skillsDefs::SKILL_HEALING;
	            $skillvalue4     = 30;
	            $professionTitle = "Samurai";
	            break;
	        case 7: // Ninja
	            $skillid1        = skillsDefs::SKILL_NINJITSU;
	            $skillvalue1     = 50;
	            $skillid2        = skillsDefs::SKILL_HIDING;
	            $skillvalue2     = 50;
	            $skillid3        = skillsDefs::SKILL_FENCING;
	            $skillvalue3     = 30;
	            $skillid4        = skillsDefs::SKILL_STEALTH;
	            $skillvalue4     = 30;
	            $professionTitle = "Ninja";
	            break;
	        default:
	            $professionTitle = "Adventurer";
	            break;
        }

        $gender  = ($genderRace % 2);
        $race    = ($genderRace <= 3 ? 0 : ($genderRace > 3 && $genderRace < 6 ? 1 : 2));
        $body    = ($genderRace <= 3 ? ($gender ? 401 : 400) : ($genderRace > 3 && $genderRace < 6 ? ($gender ? 606 : 605) : ($gender ? 667 : 666)));
        
        $newChar = [
            'name'       => $charName,
            'flags'      => $flags,
            'profession' => $profession,
            'title'      => $professionTitle,
            'sex'        => $gender,
            'race'       => $race,
            'body'       => $body,
            'color'      => [
                'skin'  => $skinColor,
                'pants' => $pantsColor,
                'shirt' => $shirtColor,
            ],
            'hair'       => [
                'style' => $hairStyle,
                'color' => $hairColor,
            ],
            'beard'      => [
                'style' => $beardStyle,
                'color' => $beardColor,
            ],
            'stats'      => [
                'str' => $str,
                'dex' => $dex,
                'int' => $int,
            ],
            'skills'     => [
                ['skill' => $skillid1, 'value' => $skillvalue1],
                ['skill' => $skillid2, 'value' => $skillvalue2],
                ['skill' => $skillid3, 'value' => $skillvalue3],
                ['skill' => $skillid4, 'value' => $skillvalue4],
            ],
            'shard'      => $shardIndex,
            'slot'       => $charSlot,
            'start'      => UltimaPHP::$starting_locations[($startCity - 1)],
            'ip'         => $clientIp,
        ];

        return UltimaPHP::$socketClients[$this->client]['account']->createNewChar($newChar, true);
    }
}