<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
 class packet_0x8D extends Packets {
     /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x8D);
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
        $size        = hexdec(Functions::implodeByte(1, 2, $data));
        $unknown1    = hexdec(Functions::implodeByte(3, 6, $data));
        $charSlot    = hexdec(Functions::implodeByte(7, 10, $data));
        $charName    = Functions::readUnicodeStringSafe(str_split(Functions::implodeByte(11, 40, $data), 2));
        $charUnknown = Functions::readUnicodeStringSafe(str_split(Functions::implodeByte(41, 70, $data), 2));
        $profession  = hexdec($data[71]);
        $cityIndex   = hexdec($data[72]);
        $gender      = hexdec($data[73]);
        $race        = hexdec($data[74]);
        $str         = hexdec($data[75]);
        $dex         = hexdec($data[76]);
        $int         = hexdec($data[77]);
        $skinColor   = hexdec(Functions::implodeByte(78, 79, $data));
        $unknown2    = hexdec(Functions::implodeByte(80, 83, $data));
        $unknown3    = hexdec(Functions::implodeByte(84, 87, $data));
        $skillid1    = hexdec($data[88]);
        $skillvalue1 = hexdec($data[89]);
        $skillid2    = hexdec($data[90]);
        $skillvalue2 = hexdec($data[91]);
        $skillid3    = hexdec($data[92]);
        $skillvalue3 = hexdec($data[93]);
        $skillid4    = hexdec($data[94]);
        $skillvalue4 = hexdec($data[95]);
        $unknown4    = hexdec(Functions::implodeByte(96, 120, $data));
        $unknown5    = hexdec($data[121]);
        $hairColor   = hexdec(Functions::implodeByte(122, 123, $data));
        $hairStyle   = hexdec(Functions::implodeByte(124, 125, $data));
        $unknown6    = hexdec($data[126]);    
        $unknown7    = hexdec(Functions::implodeByte(127, 130, $data));
        $unknown8    = hexdec($data[131]);
        $shirtColor  = hexdec(Functions::implodeByte(132, 133, $data));
        $shirtItemId = hexdec(Functions::implodeByte(134, 135, $data));
        $unknown9    = hexdec($data[136]);
        $faceColor   = hexdec(Functions::implodeByte(137, 138, $data));
        $faceId      = hexdec(Functions::implodeByte(139, 140, $data));
        $unknown10   = hexdec($data[141]);
        $beardColor  = hexdec(Functions::implodeByte(142, 143, $data));
        $beardStyle  = hexdec(Functions::implodeByte(144, 145, $data));
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
         $body    = null;
         //Human 
        if($race == 1)
        {
            //Gender
            if($gender == 0){
                $body = 400;
            }else{
                $body = 401;
            }
        //Elf
        }elseif($race == 2)
        {
            //Gender
            if($gender == 0){
                $body = 605;
            }else{
                $body = 606;
            }
        //Gargoyle
        }else
        {
            if($gender == 0){
                $body = 666;
            }else{
                $body = 667;
            }
        }
        
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
                'pants' => $shirtItemId,
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
            'face'      => [
                'style' => $faceId,
                'color' => $faceColor,
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
            'slot'       => $charSlot,
            'start'      => UltimaPHP::$starting_locations[($cityIndex - 1)],
        ];
         return UltimaPHP::$socketClients[$this->client]['account']->createNewChar($newChar, true);
    }
} 