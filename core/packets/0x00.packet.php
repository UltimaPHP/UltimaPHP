<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x00 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x00);

        if ($client) {
            $this->client = $client;
        }
    }

    /**
     * Receive the CharCreator 0x00 -  New Clients >= 7.0.16
     */
    public function receive($data) {
        if (!$this->client) {
            return false;
        }

        $command     = $data[0];
        $unknown1    = hexdec(Functions::implodeByte(1, 4, $data));
        $unknown2    = hexdec(Functions::implodeByte(5, 8, $data));
        $unknown3    = hexdec($data[9]);
        $charName    = Functions::readUnicodeStringSafe(str_split(Functions::implodeByte(10, 39, $data), 2));
        $unknown4    = hexdec(Functions::implodeByte(40, 41, $data));
        $flags       = hexdec(Functions::implodeByte(42, 45, $data));
        $unknown5    = hexdec(Functions::implodeByte(46, 49, $data));
        $loginCount  = hexdec(Functions::implodeByte(50, 53, $data));
        $profession  = hexdec($data[54]);
        $unknown6    = hexdec(Functions::implodeByte(55, 69, $data));
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
        $skinColor   = hexdec(Functions::implodeByte(80, 81, $data));
        $hairStyle   = hexdec(Functions::implodeByte(82, 83, $data));
        $hairColor   = hexdec(Functions::implodeByte(84, 85, $data));
        $beardStyle  = hexdec(Functions::implodeByte(86, 87, $data));
        $beardColor  = hexdec(Functions::implodeByte(88, 89, $data));
        $shardIndex  = hexdec($data[90]);
        $startCity   = hexdec($data[91]);
        $charSlot    = hexdec(Functions::implodeByte(92, 95, $data));
        $clientIp    = hexdec($data[96]) . "." . hexdec($data[97]) . "." . hexdec($data[98]) . "." . hexdec($data[99]);
        $shirtColor  = hexdec(Functions::implodeByte(100, 101, $data));
        $pantsColor  = hexdec(Functions::implodeByte(102, 103, $data));
        
        switch ($profession) {
            case 1: // Warrior
                $skillid1        = skillsDefs::SKILL_SWORDSMANSHIP;
                $skillvalue1     = 30;
                $skillid2        = skillsDefs::SKILL_TACTICS;
                $skillvalue2     = 50;
                $skillid3        = skillsDefs::SKILL_HEALING;
                $skillvalue3     = 45;
                $professionTitle = "Warrior";
                break;
            case 2:
                $skillid1        = skillsDefs::SKILL_EVALINT;
                $skillvalue1     = 30;
                $skillid2        = skillsDefs::SKILL_WRESTLING;
                $skillvalue2     = 30;
                $skillid3        = skillsDefs::SKILL_MAGERY;
                $skillvalue3     = 50;
                $professionTitle = "Mage";
                break;
            case 3:
                $skillid1        = skillsDefs::SKILL_MINING;
                $skillvalue1     = 30;
                $skillid2        = skillsDefs::SKILL_ARMSLORE;
                $skillvalue2     = 30;
                $skillid3        = skillsDefs::SKILL_BLACKSMITH;
                $skillvalue3     = 50;
                $professionTitle = "Blacksmith";
                break;
            case 4:
                $skillid1        = skillsDefs::SKILL_NECROMANCY;
                $skillvalue1     = 50;
                $skillid2        = skillsDefs::SKILL_FOCUS;
                $skillvalue2     = 30;
                $skillid3        = skillsDefs::SKILL_SPIRITSPEAK;
                $skillvalue3     = 30;
                $professionTitle = "Necromancer";
                break;
            case 5:
                $skillid1        = skillsDefs::SKILL_CHIVALRY;
                $skillvalue1     = 51;
                $skillid2        = skillsDefs::SKILL_SWORDSMANSHIP;
                $skillvalue2     = 49;
                $skillid3        = skillsDefs::SKILL_FOCUS;
                $skillvalue3     = 30;
                $professionTitle = "Paladin";
                break;
            case 6:
                $skillid1        = skillsDefs::SKILL_BUSHIDO;
                $skillvalue1     = 50;
                $skillid2        = skillsDefs::SKILL_SWORDSMANSHIP;
                $skillvalue2     = 50;
                $skillid3        = skillsDefs::SKILL_ANATOMY;
                $skillvalue3     = 30;
                $professionTitle = "Samurai";
                break;
            case 7: // Ninja
                $skillid1        = skillsDefs::SKILL_NINJITSU;
                $skillvalue1     = 50;
                $skillid2        = skillsDefs::SKILL_HIDING;
                $skillvalue2     = 50;
                $skillid3        = skillsDefs::SKILL_FENCING;
                $skillvalue3     = 30;
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
            ],
            'shard'      => $shardIndex,
            'slot'       => $charSlot,
            'start'      => UltimaPHP::$starting_locations[($startCity - 1)],
            'ip'         => $clientIp,
        ];

        UltimaPHP::$socketClients[$this->client]['account']->createNewChar($newChar, true);

        return true;
    }
}