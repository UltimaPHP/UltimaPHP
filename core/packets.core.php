<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Packets
{
    
    /**
     * Strange package sent from client sometimes on login process
     */
    public static function packet_0x1($data, $client) {
        if (count($data) == 70) {
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
            $packet.= str_pad(dechex($ip[3]), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex($ip[2]), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex($ip[1]), 2, "0", STR_PAD_LEFT);
            $packet.= str_pad(dechex($ip[0]), 2, "0", STR_PAD_LEFT);
            
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
        
        UltimaPHP::$socketClients[$client]['account'] = array('account' => $account, 'password' => sha1($password));
        UltimaPHP::log("Account $account connected from " . UltimaPHP::$socketClients[$client]['ip']);
        
        if (strlen($account) > 0 && strlen($password) > 0) {
            $login = true;
        }
        
        if ($login === true) {
            $packet = "B9110882DF"; // ???? How to mont this flags?
            Sockets::out($client, $packet);
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
            echo "0x82 4\n";
            self::packet_0x82("", $client, 4);
            return;
        }
        $command = $data[0];
        $seed = Functions::getDword($data[1] . $data[2] . $data[3] . $data[4]);
        $major = Functions::getDword($data[5] . $data[6] . $data[7] . $data[8]);
        $minor = Functions::getDword($data[9] . $data[10] . $data[11] . $data[12]);
        $revision = Functions::getDword($data[13] . $data[14] . $data[15] . $data[16]);
        $prototype = Functions::getDword($data[17] . $data[18] . $data[19] . $data[20]);
        
        UltimaPHP::$socketClients[$client]['version'] = array('major' => $major, 'minor' => $minor, 'revision' => $revision, 'prototype' => $prototype,);
    }
}
?>