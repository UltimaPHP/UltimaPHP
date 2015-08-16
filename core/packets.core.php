<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Packets
{
    
    /**
     * Packet list with the packet length, note: dynamic packets are marked with -1 this way the server looks on the packet for the right length
     */
    static $packets = array(0x00 => 0x0068, 0x01 => 0x0005, 0x02 => 0x0007, 0x03 => false, 0x04 => 0x0002, 0x05 => 0x0005, 0x06 => 0x0005, 0x07 => 0x0007, 0x08 => 0x000E, 0x09 => 0x0005, 0x0A => 0x000B, 0x0B => 0x010A, 0x0C => false, 0x0D => 0x0003, 0x0E => false, 0x0F => 0x003D, 0x10 => 0x00D7, 0x11 => false, 0x12 => false, 0x13 => 0x000A, 0x14 => 0x0006, 0x15 => 0x0009, 0x16 => 0x0001, 0x17 => false, 0x18 => false, 0x19 => false, 0x1A => false, 0x1B => 0x0025, 0x1C => false, 0x1D => 0x0005, 0x1E => 0x0004, 0x1F => 0x0008, 0x20 => 0x0013, 0x21 => 0x0008, 0x22 => 0x0003, 0x23 => 0x001A, 0x24 => 0x0007, 0x25 => 0x0014, 0x26 => 0x0005, 0x27 => 0x0002, 0x28 => 0x0005, 0x29 => 0x0001, 0x2A => 0x0005, 0x2B => 0x0002, 0x2C => 0x0002, 0x2D => 0x0011, 0x2E => 0x000F, 0x2F => 0x000A, 0x30 => 0x0005, 0x31 => 0x0001, 0x32 => 0x0002, 0x33 => 0x0002, 0x34 => 0x000A, 0x35 => 0x028D, 0x36 => false, 0x37 => 0x0008, 0x38 => 0x0007, 0x39 => 0x0009, 0x3A => false, 0x3B => false, 0x3C => false, 0x3D => 0x0002, 0x3E => 0x0025, 0x3F => false, 0x40 => 0x00C9, 0x41 => false, 0x42 => false, 0x43 => 0x0229, 0x44 => 0x02C9, 0x45 => 0x0005, 0x46 => false, 0x47 => 0x000B, 0x48 => 0x0049, 0x49 => 0x005D, 0x4A => 0x0005, 0x4B => 0x0009, 0x4C => false, 0x4D => false, 0x4E => 0x0006, 0x4F => 0x0002, 0x50 => false, 0x51 => false, 0x52 => false, 0x53 => 0x0002, 0x54 => 0x000C, 0x55 => 0x0001, 0x56 => 0x000B, 0x57 => 0x006E, 0x58 => 0x006A, 0x59 => false, 0x5A => false, 0x5B => 0x0004, 0x5C => 0x0002, 0x5D => 0x0049, 0x5E => false, 0x5F => 0x0031, 0x60 => 0x0005, 0x61 => 0x0009, 0x62 => 0x000F, 0x63 => 0x000D, 0x64 => 0x0001, 0x65 => 0x0004, 0x66 => false, 0x67 => 0x0015, 0x68 => false, 0x69 => false, 0x6A => 0x0003, 0x6B => 0x0009, 0x6C => 0x0013, 0x6D => 0x0003, 0x6E => 0x000E, 0x6F => false, 0x70 => 0x001C, 0x71 => false, 0x72 => 0x0005, 0x73 => 0x0002, 0x74 => false, 0x75 => 0x0023, 0x76 => 0x0010, 0x77 => 0x0011, 0x78 => false, 0x79 => 0x0009, 0x7A => false, 0x7B => 0x0002, 0x7C => false, 0x7D => 0x000D, 0x7E => 0x0002, 0x7F => false, 0x80 => 0x003E, 0x81 => false, 0x82 => 0x0002, 0x83 => 0x0027, 0x84 => 0x0045, 0x85 => 0x0002, 0x86 => false, 0x87 => false, 0x88 => 0x0042, 0x89 => false, 0x8A => false, 0x8B => false, 0x8C => 0x000B, 0x8D => false, 0x8E => false, 0x8F => false, 0x90 => 0x0013, 0x91 => 0x0041, 0x92 => false, 0x93 => 0x0063, 0x94 => false, 0x95 => 0x0009, 0x96 => false, 0x97 => 0x0002, 0x98 => false, 0x99 => 0x001A, 0x9A => false, 0x9B => 0x0102, 0x9C => 0x0135, 0x9D => 0x0033, 0x9E => false, 0x9F => false, 0xA0 => 0x0003, 0xA1 => 0x0009, 0xA2 => 0x0009, 0xA3 => 0x0009, 0xA4 => 0x0095, 0xA5 => false, 0xA6 => false, 0xA7 => 0x0004, 0xA8 => false, 0xA9 => false, 0xAA => 0x0005, 0xAB => false, 0xAC => false, 0xAD => false, 0xAE => false, 0xAF => 0x000D, 0xB0 => false, 0xB1 => false, 0xB2 => false, 0xB3 => false, 0xB4 => false, 0xB5 => 0x0040, 0xB6 => 0x0009, 0xB7 => false, 0xB8 => false, 0xB9 => 0x0003, 0xBA => 0x0006, 0xBB => 0x0009, 0xBC => 0x0003, 0xBD => - 1, 0xBE => false, 0xBF => - 1, 0xC0 => 0x0024, 0xC1 => false, 0xC2 => false, 0xC3 => false, 0xC4 => 0x0006, 0xC5 => 0x00CB, 0xC6 => 0x0001, 0xC7 => 0x0031, 0xC8 => 0x0002, 0xC9 => 0x0006, 0xCA => 0x0006, 0xCB => 0x0007, 0xCC => false, 0xCD => 0x0001, 0xCE => false, 0xCF => 0x004E, 0xD0 => false, 0xD1 => 0x0002, 0xD2 => 0x0019, 0xD3 => false, 0xD4 => false, 0xD5 => false, 0xD6 => false, 0xD7 => false, 0xD8 => false, 0xD9 => 0x010C, 0xDA => false, 0xDB => false, 0xDC => 9, 0xDD => 1, 0xDE => 1, 0xDF => 1, 0xE0 => 1, 0xE1 => 9, 0xE2 => 10, 0xE3 => 77, 0xEC => 1, 0xED => 1, 0xEF => 21, 0xF0 => 1, 0xF1 => 1, 0xF3 => 24, 0xF5 => 21, 0xF8 => 106);
    
    /**
     * Strange package received from client in the login proccess...
     */
    public static function packet_0x1($data, $client) {
        if (count($data) >= 68) {
            $major = hexdec($data[0]);
            $minor = hexdec($data[1]);
            $revision = hexdec($data[2]);
            $prototype = hexdec($data[3]);
            
            UltimaPHP::$socketClients[$client]['version'] = array('major' => $major, 'minor' => $minor, 'revision' => $revision, 'prototype' => $prototype);
            
            self::packet_0x91(array_slice($data, 4), $client, true);
        }
    }
    
    /**
     * Send to the client the locale and body information
     */
    public static function packet_0x1B($data, $client) {
        $player_serial = 442500;
        $body_type = 987;
        $pos = array('x' => 100, 'y' => 100, 'z' => 5, 'facing' => 6);
        $map_size = array('x' => 6144, 'y' => 4096);
        
        $packet = "1B";
        $packet.= str_pad(dechex($player_serial), 8, "0", STR_PAD_LEFT);
        $packet.= "00000000";
        $packet.= str_pad(dechex($body_type), 4, "0", STR_PAD_LEFT);
        $packet.= str_pad(dechex($pos['x']), 4, "0", STR_PAD_LEFT);
        $packet.= str_pad(dechex($pos['y']), 4, "0", STR_PAD_LEFT);
        $packet.= "00";
        $packet.= str_pad(dechex($pos['z']), 2, "0", STR_PAD_LEFT);
        $packet.= str_pad(dechex($pos['facing']), 2, "0", STR_PAD_LEFT);
        $packet.= "00FFFFFF";
        $packet.= "FF000000";
        $packet.= "00";
        $packet.= str_pad(dechex($map_size['x']), 2, "0", STR_PAD_LEFT);
        $packet.= str_pad(dechex($map_size['y']), 2, "0", STR_PAD_LEFT);
        $packet.= "0000";
        $packet.= "00000000";
        
        Sockets::out($client, $packet);
    }
    
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
        $unknow = $data[1] . $data[2] . $data[3] . $data[4];
        $type = $data[5];
        $serial = array($data[6], $data[7], $data[8], $data[9]);
        
        switch ($type) {
            case 0x00:
                
                // God client ???
                break;

            case 0x04:
                
                // Client asking to server send the status information to the client
                break;

            case 0x05:
                
                // Client asking to server send the skills information to the client
                self::packet_0x3A($serial, $client);
                break;

            default:
                
                // Unknow status type received
                break;
        }
    }
    
    /**
     * Send the skills information to the client
     */
    public static function packet_0x3A($data, $client, $type = 2) {
        $skills = 58;
        $tmpPacket = str_pad(dechex($type), 2, "0", STR_PAD_LEFT);
        for ($i = 1; $i <= 58; $i++) {
            $tmpPacket.= str_pad(dechex($i), 4, "0", STR_PAD_LEFT);
            $tmpPacket.= str_pad(dechex(1000), 4, "0", STR_PAD_LEFT);
            $tmpPacket.= str_pad(dechex(1000), 4, "0", STR_PAD_LEFT);
            $tmpPacket.= "00";
            $tmpPacket.= str_pad(dechex(1000), 4, "0", STR_PAD_LEFT);
        }
        $tmpPacket.= "0000";
        
        $packet = "3A";
        $packet.= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 3), 4, "0", STR_PAD_LEFT);
        $packet.= $tmpPacket;
        
        Sockets::out($client, $packet);
    }
    
    /**
     * Packet received after client choose a character
     */
    public static function packet_0x5D($data, $client) {
        $command = $data[0];
        $charname = Functions::hexToChr($data, 5, 34, true);
        $clientflag = Functions::hexToChr($data, 37, 40, true);
        $loginaccount = Functions::hexToChr($data, 45, 48, true);
        $slotchoosen = hexdec($data[65] . $data[66] . $data[67] . $data[68]);
        $clientIP = hexdec($data[69]) . "." . hexdec($data[70]) . "." . hexdec($data[71]) . "." . hexdec($data[72]);
        
        UltimaPHP::$socketClients[$client]['connected'] = array('slotchoosen' => $slotchoosen, 'charname' => $charname, 'loginaccount' => $loginaccount, 'clientIP' => $clientIP, 'clientFlag' => $clientflag);
        
        self::packet_0x1B("", $client);
    }
    
    /**
     * Send ping response to the client
     */
    public static function packet_0x73($data, $client) {
        $packet = Functions::strToHex(chr(115) . chr(1));
        Sockets::out($client, $packet);
    }
    
    /**
     * Receive login request from client
     */
    public static function packet_0x80($data, $client) {
        $command = $data[0];
        $account = Functions::hexToChr($data, 1, 30, true);
        $password = Functions::hexToChr($data, 31, 61, true);
        
        $login = false;
        
        // Account / Password validadion TODO
        UltimaPHP::$socketClients[$client]['account'] = array('account' => $account, 'password' => md5($password));
        UltimaPHP::log("Account $account connected from " . UltimaPHP::$socketClients[$client]['ip']);
        
        $acc = new Account($account, md5($password), $client);
        
        if ($acc->isValid === true) {
            $login = true;
        }
        
        if ($login === true) {
            self::packet_0xA8("", $client);
        } 
        else {
            self::packet_0x82("", $client, 3);
        }
    }
    
    /**
     * Disconnect player from server
     *
     * Reasons:
     * 0 - Incorrect name/password.
     * 1 - Someone is already using this account.
     * 2 - Your account has been blocked.
     * 3 - Your account credentials are invalid.
     * 4 - Communication problem. [DEFAULT]
     * 5 - The IGR concurrency limit has been met.
     * 6 - The IGR time limit has been met.
     * 7 - General IGR authentication failure.
     */
    public static function packet_0x82($data, $client, $reason = 4) {
        $packet = chr(130) . chr(hexdec($reason));
        UltimaPHP::log("Client " . UltimaPHP::$socketClients[$client]['ip'] . " disconnected from the server");
        Sockets::out($client, $packet, null, true, true);
    }
    
    /**
     * Send the connection confirmation of selected server
     */
    public static function packet_0x8C($data, $client) {
        if (isset(UltimaPHP::$socketClients[$client]['connected_server'])) {
            $ip = explode(".", UltimaPHP::$servers[UltimaPHP::$socketClients[$client]['connected_server']]['ip']);
            
            $packet = "8C";
            $packet.= str_pad(dechex($ip[0]), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex($ip[1]), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex($ip[2]), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex($ip[3]), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex(UltimaPHP::$servers[UltimaPHP::$socketClients[$client]['connected_server']]['port']), 4, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex(UltimaPHP::$socketClients[$client]['version']['major']), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex(UltimaPHP::$socketClients[$client]['version']['minor']), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex(UltimaPHP::$socketClients[$client]['version']['revision']), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex(UltimaPHP::$socketClients[$client]['version']['prototype']), 2, "0", STR_PAD_LEFT);
            
            Sockets::out($client, $packet);
        } 
        else {
            self::packet_0x82("", $client, 4);
        }
    }
    
    /**
     * Send to the client the features from server
     */
    public static function packet_0x91($data, $client, $redirected = false) {
        $command = $data[0];
        $keyUsed = hexdec($data[1]) . hexdec($data[2]) . hexdec($data[3]) . hexdec($data[4]);
        $account = Functions::hexToChr($data, 5, 34, true);
        $password = Functions::hexToChr($data, 35, 64, true);
        
        $login = false;
        
        $acc = new Account($account, md5($password), $client);
        
        if ($acc->isValid === true) {
            $login = true;
        }
        
        if ($login === true) {
            UltimaPHP::log("Account $account logged from " . UltimaPHP::$socketClients[$client]['ip']);
            
            // Set the flag on the connection to send next packets compressed
            UltimaPHP::$socketClients[$client]['compressed'] = true;
            
            self::packet_0xB9("", $client);
            self::packet_0xA9("", $client);
        } 
        else {
            self::packet_0x82("", $client, 3);
        }
    }
    
    /**
     * Receive the selected server from client
     */
    public static function packet_0xA0($data, $client) {
        $server = Functions::getDword($data[1] . $data[2]);
        UltimaPHP::$socketClients[$client]['connected_server'] = ((int)$server - 1);
        UltimaPHP::log("Account " . UltimaPHP::$socketClients[$client]['account']->account . " connecting on server " . UltimaPHP::$servers[UltimaPHP::$socketClients[$client]['connected_server']]['name']);
        self::packet_0x8C("", $client);
    }
    
    /**
     * Send the server list to the client
     */
    public static function packet_0xA8($data, $client) {
        $packet = "";
        $tmpPacket = "";
        foreach (UltimaPHP::$servers as $key => $server) {
            $ip = explode(".", $server['ip']);
            
            $tmpPacket.= str_pad(dechex(($key + 1)), 4, "0", STR_PAD_LEFT);
            $tmpPacket.= str_pad(Functions::strToHex($server['name']), 64, "0", STR_PAD_RIGHT);
            $tmpPacket.= str_pad(dechex($server['full']), 2, "0", STR_PAD_LEFT);
            $tmpPacket.= str_pad(dechex($server['timezone']), 2, "0", STR_PAD_LEFT);
            $tmpPacket.= str_pad(dechex($ip[3]), 2, "0", STR_PAD_LEFT);
            $tmpPacket.= str_pad(dechex($ip[2]), 2, "0", STR_PAD_LEFT);
            $tmpPacket.= str_pad(dechex($ip[1]), 2, "0", STR_PAD_LEFT);
            $tmpPacket.= str_pad(dechex($ip[0]), 2, "0", STR_PAD_LEFT);
        }
        
        $packet = "A8";
        $packet.= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 6), 4, "0", STR_PAD_LEFT);
        $packet.= "FF";
        $packet.= str_pad(dechex(count(UltimaPHP::$servers)), 4, "0", STR_PAD_LEFT);
        $packet.= $tmpPacket;
        
        Sockets::out($client, $packet);
    }
    
    /**
     * Send the account characters to the client
     */
    public static function packet_0xA9($data, $client) {
        $characters = array(array('name' => "Player 1"), array('name' => "Player 2"));
        $startingLocations = array(array('name' => "Yew", 'area' => 'The Sturdy Bow', 'position' => array("x" => 567, "y" => 978, "z" => 0, 'map' => 0), 'clioc' => 1075072), array('name' => "Minoc", 'area' => 'The Barnacle Tavern', 'position' => array("x" => 2477, "y" => 407, "z" => 15, 'map' => 0), 'clioc' => 1075073), array('name' => "Britain", 'area' => 'Sweet Dreams Inn', 'position' => array("x" => 1496, "y" => 1629, "z" => 10, 'map' => 0), 'clioc' => 1075074), array('name' => "Moonglow", 'area' => 'The Scholars Inn', 'position' => array("x" => 4404, "y" => 1169, "z" => 0, 'map' => 0), 'clioc' => 1075075), array('name' => "Trinsic", 'area' => 'The Traveller\'s Inn', 'position' => array("x" => 1844, "y" => 2745, "z" => 0, 'map' => 0), 'clioc' => 1075076), array('name' => "New Magincia", 'area' => 'The Great Horns Tavern', 'position' => array("x" => 3738, "y" => 2223, "z" => 20, 'map' => 0), 'clioc' => 1075077), array('name' => "Jhelom", 'area' => 'The Morning Star Inn', 'position' => array("x" => 1378, "y" => 3817, "z" => 0, 'map' => 0), 'clioc' => 1075078), array('name' => "Skara Brae", 'area' => 'The Falconers Inn', 'position' => array("x" => 594, "y" => 2227, "z" => 0, 'map' => 0), 'clioc' => 1075079), array('name' => "Vesper", 'area' => 'The Ironwood Inn', 'position' => array("x" => 2771, "y" => 977, "z" => 0, 'map' => 0), 'clioc' => 1075080));
        
        $tmpPacket = "05";
        
        for ($i = 0; $i < 5; $i++) {
            $tmpPacket.= str_pad((isset($characters[$i]) ? Functions::strToHex($characters[$i]['name']) : 0), 120, "0", STR_PAD_RIGHT);
        }
        
        $tmpPacket.= str_pad(dechex(count($startingLocations)), 2, "0", STR_PAD_LEFT);
        foreach ($startingLocations as $key => $location) {
            
            // If Client version is bigger then 7.0.13.0
            if (isset(UltimaPHP::$socketClients[$client]['version']) && UltimaPHP::$socketClients[$client]['version']['major'] >= 7 && UltimaPHP::$socketClients[$client]['version']['minor'] >= 0 && UltimaPHP::$socketClients[$client]['version']['revision'] >= 13 && UltimaPHP::$socketClients[$client]['version']['prototype'] >= 0) {
                $tmpPacket.= str_pad(dechex($key + 1), 2, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(Functions::strToHex($location['name']), 64, "0", STR_PAD_RIGHT);
                $tmpPacket.= str_pad(Functions::strToHex($location['area']), 64, "0", STR_PAD_RIGHT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['position']['x'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['position']['y'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['position']['z'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['position']['map'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['clioc'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad("", 8, "0", STR_PAD_RIGHT);
            } 
            else {
                $tmpPacket.= str_pad(dechex($key + 1), 2, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(Functions::strToHex($location['name']), 62, "0", STR_PAD_RIGHT);
                $tmpPacket.= str_pad(Functions::strToHex($location['area']), 62, "0", STR_PAD_RIGHT);
            }
        }
        
        $flags = "0580";
        $tmpPacket.= str_pad($flags, 8, "0", STR_PAD_LEFT);
        $tmpPacket.= "0000";
        
        $packet = "A9";
        $packet.= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 3), 4, "0", STR_PAD_LEFT);
        $packet.= $tmpPacket;
        
        Sockets::out($client, $packet, Functions::hexToChr("B30CEC99E8D0"));
    }
    
    /**
     * Enable locked client features
     */
    public static function packet_0xB9($data, $client) {
        $packet = "B9000C829F";
        Sockets::out($client, $packet);
    }
    
    /**
     * Receive client version information after connect to the server
     */
    public static function packet_0xBD($data, $client) {
        $comand = $data[0];
        $length = hexdec($data[1] . $data[2]);
        $version = explode(".", Functions::hexToChr(implode("", array_slice($data, 3))));
        
        UltimaPHP::$socketClients[$client]['version'] = array('major' => $version[0], 'minor' => $version[1], 'revision' => $version[2], 'prototype' => $version[3]);
    }
    
    /**
     * Send/Request general information
     */
    public static function packet_0xBF($data, $client) {
        $comand = $data[0];
        $length = hexdec($data[1] . $data[2]);
        $subcomand = hexdec($data[3] . $data[4]);
        
        switch ($subcomand) {
            case 5:
                
                // Screen Size
                $unknow1 = Functions::hexToChr($data, 5, 6, true);
                $x = Functions::hexToChr($data, 7, 8, true);
                $y = Functions::hexToChr($data, 9, 10, true);
                $unknow2 = Functions::hexToChr($data, 11, 12, true);
                break;

            case 11:
                
                // Client language
                $language = Functions::hexToChr($data, 5, 8);
                UltimaPHP::$socketClients[$client]['language'] = $language;
                break;

            case 15:
                
                // ClientType
                $unk1 = hexdec($data[5]);
                $ClientType = Functions::hexToChr($data, 6, 9);
                UltimaPHP::$socketClients[$client]['type'] = $ClientType;
                
                // Send the next packets in the next two second
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 1), 0.2);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 2), 0.4);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 3), 0.6);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 4), 0.8);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 5), 1.0);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 6), 1.2);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 7), 1.4);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 8), 1.6);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 9), 1.8);
                Sockets::addEvent($client, array("class" => "Packets", "method" => "todoPackets", "args" => 10), 2.0);
                break;
        }
    }
    
    public static function todoPackets($data, $client, $args) {
        echo "Sending loop $args\n";
        switch ($args) {
            case 1:
                
                $packet = "BF0600000800";
                break;

            case 2:
                $packet = "BF310000180000000500000000000000000000000000000000000000000000000000000000000000000000000000000000";
                break;

            case 3:
                $packet = "6D001B";
                break;

            case 4:
                $packet = "65FF0010";
                break;

            case 5:
                $packet = "BC0101";
                break;

            case 6:
                $packet = "4F00";
                break;

            case 7:
                $packet = "BF0600000800";
                break;

            case 8:
                $packet = "7835000006C08803DB05C606C4000683EA18074001B94E0E75154000FAEB90960901BE40070B1F3EA6194004BCA01F0B0600000000";
                break;

            case 9:
                $packet = "170F000006C0880002000100000200";
                break;

            case 10:
                $packet = "200006C08803DB0083EA1805C606C400000600";
                break;
        }
        
        Sockets::out($client, $packet);
    }
    
    /**
     * Receive client version information
     */
    public static function packet_0xEF($data, $client) {
        if (count($data) < 21) {
            self::packet_0x82("", $client, 4);
            return;
        }
        
        $command = $data[0];
        $seed = Functions::getDword($data[1] . $data[2] . $data[3] . $data[4]);
        $major = Functions::getDword($data[5] . $data[6] . $data[7] . $data[8]);
        $minor = Functions::getDword($data[9] . $data[10] . $data[11] . $data[12]);
        $revision = Functions::getDword($data[13] . $data[14] . $data[15] . $data[16]);
        $prototype = Functions::getDword($data[17] . $data[18] . $data[19] . $data[20]);
        
        UltimaPHP::$socketClients[$client]['version'] = array('major' => $major, 'minor' => $minor, 'revision' => $revision, 'prototype' => $prototype);
    }
}
?>