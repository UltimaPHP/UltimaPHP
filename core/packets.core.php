<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Packets
{
    
    /**
     * Strange package received from client in the login proccess...
     */
    public static function packet_0x1($data, $client) {
        if (count($data) == 70) {
            $major = hexdec($data[0]);
            $minor = hexdec($data[1]);
            $revision = hexdec($data[2]);
            $prototype = hexdec($data[3]);
            
            UltimaPHP::$socketClients[$client]['version'] = array('major' => $major, 'minor' => $minor, 'revision' => $revision, 'prototype' => $prototype);

            self::packet_0x91(array_slice($data,4), $client, true);
        }
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
        UltimaPHP::$socketClients[$client]['account'] = array('account' => $account, 'password' => sha1($password));
        UltimaPHP::log("Account $account connected from " . UltimaPHP::$socketClients[$client]['ip']);
        
        if (strlen($account) > 0 && strlen($password) > 0) {
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
     * Receive the selected server from client
     */
    public static function packet_0xA0($data, $client) {
        $server = Functions::getDword($data[1] . $data[2]);
        UltimaPHP::$socketClients[$client]['connected_server'] = ((int)$server - 1);
        UltimaPHP::log("Account " . UltimaPHP::$socketClients[$client]['account']['account'] . " connecting on server " . UltimaPHP::$servers[UltimaPHP::$socketClients[$client]['connected_server']]['name']);
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
        $packet = "";

        $characters = array(
            array('name' => "Player 1"),
            array('name' => "Player 2")
        );

        $startingLocations = array(
            array(
                'name' => "Yew",
                'area' => 'The Sturdy Bow',
                'position' => array("x" => 567, "y" => 978, "z" => 0, 'map' => 0),
                'clioc' => 1075072
            ),
            array(
                'name' => "Minoc",
                'area' => 'The Barnacle Tavern',
                'position' => array("x" => 2477, "y" => 407, "z" => 15, 'map' => 0),
                'clioc' => 1075073
            ),
            array(
                'name' => "Britain",
                'area' => 'Sweet Dreams Inn',
                'position' => array("x" => 1496, "y" => 1629, "z" => 10, 'map' => 0),
                'clioc' => 1075074
            ),
            array(
                'name' => "Moonglow",
                'area' => 'The Scholars Inn',
                'position' => array("x" => 4404, "y" => 1169, "z" => 0, 'map' => 0),
                'clioc' => 1075075
            ),
            array(
                'name' => "Trinsic",
                'area' => 'The Traveller\'s Inn',
                'position' => array("x" => 1844, "y" => 2745, "z" => 0, 'map' => 0),
                'clioc' => 1075076
            ),
            array(
                'name' => "New Magincia",
                'area' => 'The Great Horns Tavern',
                'position' => array("x" => 3738, "y" => 2223, "z" => 20, 'map' => 0),
                'clioc' => 1075077
            ),
            array(
                'name' => "Jhelom",
                'area' => 'The Morning Star Inn',
                'position' => array("x" => 1378, "y" => 3817, "z" => 0, 'map' => 0),
                'clioc' => 1075078
            ),
            array(
                'name' => "Skara Brae",
                'area' => 'The Falconers Inn',
                'position' => array("x" => 594, "y" => 2227, "z" => 0, 'map' => 0),
                'clioc' => 1075079
            ),
            array(
                'name' => "Vesper",
                'area' => 'The Iron wood Inn',
                'position' => array("x" => 2771, "y" => 977, "z" => 0, 'map' => 0),
                'clioc' => 1075080
            )
        );

        $tmpPacket = "05";

        for ($i=0; $i < 5; $i++) { 
            $tmpPacket.= str_pad((isset($characters[$i]) ? Functions::strToHex($characters[$i]['name']) : 0), 120, "0", STR_PAD_RIGHT);
        }

        $tmpPacket .= str_pad(dechex(count($startingLocations)), 2, "0", STR_PAD_LEFT);
        foreach ($startingLocations as $key => $location) {
            // If Client version is bigger then 7.0.13.0
            if (isset(UltimaPHP::$socketClients[$client]['version']) && UltimaPHP::$socketClients[$client]['version']['major'] >= 7 && UltimaPHP::$socketClients[$client]['version']['minor'] >= 0 && UltimaPHP::$socketClients[$client]['version']['revision'] >= 13 && UltimaPHP::$socketClients[$client]['version']['prototype'] >= 0) {
                $tmpPacket .= str_pad(dechex($key+1), 2, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(Functions::strToHex($location['name']), 64, "0", STR_PAD_RIGHT);
                $tmpPacket.= str_pad(Functions::strToHex($location['area']), 64, "0", STR_PAD_RIGHT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['position']['x'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['position']['y'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['position']['z'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['position']['map'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad(strtoupper(dechex($location['clioc'])), 8, "0", STR_PAD_LEFT);
                $tmpPacket.= str_pad("", 8, "0", STR_PAD_RIGHT);
            } else {
                $tmpPacket .= str_pad(dechex($key+1), 2, "0", STR_PAD_LEFT);
                $tmpPacket .= str_pad(Functions::strToHex($location['name']), 62, "0", STR_PAD_RIGHT);
                $tmpPacket .= str_pad(Functions::strToHex($location['area']), 62, "0", STR_PAD_RIGHT);
            }
        }

        $flags = "0580";
        $tmpPacket .= str_pad($flags, 8, "0", STR_PAD_LEFT);
        $tmpPacket .= "0000";

        $packet = "A9";
        $packet.= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 3), 4, "0", STR_PAD_LEFT);
        $packet.= $tmpPacket;

        Sockets::out($client, $packet);
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
        $packet = Functions::strToHex(chr(130) . chr(hexdec($reason)));
        UltimaPHP::log("Client " . UltimaPHP::$socketClients[$client]['ip'] . " disconnected from the server");
        Sockets::out($client, $packet);
        unset(UltimaPHP::$socketClients[$client]);
    }
    
    /**
     * Send to the client the features from server
     */
    public static function packet_0x91($data, $client, $redirected = false) {
        $command = $data[0];
        $keyUsed = hexdec($data[1]).hexdec($data[2]).hexdec($data[3]).hexdec($data[4]);
        $account = Functions::hexToChr($data, 5, 35, true);
        $password = Functions::hexToChr($data, 36, 65, true);

        $login = false;
        
        if (strlen($account) > 0 && strlen($password) > 0) {
            $login = true;
        }
        
        if ($login === true) {
            UltimaPHP::$socketClients[$client]['account'] = array('account' => $account, 'password' => sha1($password));
            UltimaPHP::log("Account $account logged from " . UltimaPHP::$socketClients[$client]['ip']);

            // Set the flag on the connection to send next packets compressed
            UltimaPHP::$socketClients[$client]['compressed'] = true;

            self::packet_0xA9("", $client);
        } 
        else {
            self::packet_0x82("", $client, 3);
        }
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