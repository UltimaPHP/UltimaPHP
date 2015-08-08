<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Packets
{
    
    /**
     * Receive login request from client
     */
    public static function packet_0x80($data, $client) {
        $command = $data[0];
        $account = Functions::hexToStr($data, 1, 30, true);
        $password = Functions::hexToStr($data, 31, 61, true);
        
        $login = false;

        // Account / Password validadion TODO
        UltimaPHP::$socketClients[$client]['account'] = array('account' => $account, 'password' => sha1($password));
        UltimaPHP::log("Account $account connected from " . UltimaPHP::$socketClients[$client]['ip']);

        if (strlen($account) > 0 && strlen($password) > 0) {
            $login = true;
        }

        if ($login === true) {
        	Sockets::addEvent($client, array("class" => "Packets", "method" => "packet_0xA8"), 0.01);
        } else {
        	Sockets::addEvent($client, array("class" => "Packets", "method" => "packet_0x82", "args" => 3), 0.01);
        }
    }

    /**
     * Send the server list to the client
     */
    public static function packet_0xA8($data, $client) {
    	$packet = "";
		$servers = array(
			array(
				'name' => UltimaPHP::$conf['server']['name'],
                'ip' => UltimaPHP::$conf['server']['ip'],
				'port' => UltimaPHP::$conf['server']['port'],
				'full' => (UltimaPHP::$conf['server']['max_players'] == 0 ? 0 : ceil((UltimaPHP::$clients/UltimaPHP::$conf['server']['max_players']) * 100)),
				'timezone' => 3
			)
		);

		$tmpPacket = "";
		foreach ($servers as $key => $server) {
			$ip = explode(".", $server['ip']);

            $tmpPacket .= str_pad(dechex(($key+1)), 4, "0", STR_PAD_LEFT);
			$tmpPacket .= str_pad(Functions::strToHex($server['name']), 64, "0", STR_PAD_RIGHT);
			$tmpPacket .= str_pad(dechex($server['full']), 2, "0", STR_PAD_LEFT);
			$tmpPacket .= str_pad(dechex($server['timezone']), 2, "0", STR_PAD_LEFT);
			$tmpPacket .= str_pad(dechex($ip[3]), 2, "0", STR_PAD_LEFT);
			$tmpPacket .= str_pad(dechex($ip[2]), 2, "0", STR_PAD_LEFT);
			$tmpPacket .= str_pad(dechex($ip[1]), 2, "0", STR_PAD_LEFT);
			$tmpPacket .= str_pad(dechex($ip[0]), 2, "0", STR_PAD_LEFT);
		}

        $packet = "A8";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 6), 4, "0", STR_PAD_RIGHT);
        $packet .= "FF";
        $packet .= str_pad(dechex(count($servers)), 4, "0", STR_PAD_LEFT);
		$packet .= $tmpPacket;

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
    }
    
    /**
     * Receive client version information
     */
    public static function packet_0xEF($data, $client) {
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