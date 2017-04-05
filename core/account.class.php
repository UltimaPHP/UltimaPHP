<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Account {
    /* Server variables */

    public $isValid = false;
    public $client;

    /* Account information variables */
    public $serial;
    public $account;
    public $password;
    public $maxchars;
    public $creation_date;
    public $last_login;
    public $plevel;
    public $status;

    /* Character object array */
    public $characters = null;

    /* Logged player variables */
    public $player = null;

    /**
     * Looks for the account credentials in the database and define the base variables
     */
    public function __construct($account = null, $password = null, $client = null) {
        $this->client = $client;

        $query = "SELECT
                        a.id,
                        a.account,
                        a.password,
                        a.maxchars,
                        a.creation_date,
                        a.last_login,
                        a.plevel,
                        a.status
                    FROM
                        accounts a
                    WHERE
                        a.account = :account and
                        a.password = :password and
                        a.status = 1";

        $sth = UltimaPHP::$db->prepare($query);
        $sth->execute(array(
            ":account"  => $account,
            ":password" => $password,
        ));
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (isset($result[0])) {
            $this->serial        = $result[0]['id'];
            $this->account       = $result[0]['account'];
            $this->password      = $result[0]['password'];
            $this->maxchars      = $result[0]['maxchars'];
            $this->creation_date = $result[0]['creation_date'];
            $this->last_login    = $result[0]['last_login'];
            $this->plevel        = $result[0]['plevel'];
            $this->status        = $result[0]['status'];
            $this->characters    = $this->getCharacterList();
            $this->isValid       = true;

            return $this;
        }
    }

    /**
     * Send ping response to the client
     */
    public function sendPingResponse($runInLot = false) {
        $packet = "7301";
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Update the initial list of charactes in the account to show the character list
     */
    public function getCharacterList() {
        if (null === $this->characters) {
            $query = "SELECT
                        a.id,
                        a.name
                    FROM
                        players a
                    WHERE
                        a.account = :account_serial";

            $sth = UltimaPHP::$db->prepare($query);
            $sth->execute(array(
                ":account_serial" => $this->serial,
            ));
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            $chars = array();
            foreach ($result as $char) {
                $chars[] = array(
                    'serial' => (442500 + $char['id']),
                    'name'   => $char['name'],
                );
            }

            return $chars;
        } else {
            return $this->characters;
        }
    }

    /**
     * Send the server list to the client
     */
    public function sendServerList($runInLot = false) {
        $packet    = "";
        $tmpPacket = "";
        foreach (UltimaPHP::$servers as $key => $server) {
            $ip = explode(".", $server['ip']);

            $tmpPacket .= str_pad(dechex(($key + 1)), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(Functions::strToHex($server['name']), 64, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(dechex($server['full']), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($server['timezone']), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($ip[3]), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($ip[2]), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($ip[1]), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($ip[0]), 2, "0", STR_PAD_LEFT);
        }

        $packet = "A8";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 6), 4, "0", STR_PAD_LEFT);
        $packet .= "FF";
        $packet .= str_pad(dechex(count(UltimaPHP::$servers)), 4, "0", STR_PAD_LEFT);
        $packet .= $tmpPacket;

        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Enable locked client features
     */
    public function enableLockedFeatures($runInLot = false) {
        $tmpPacket = "";
        $expansion = dechex(clientDefs::EXPANSION_TOL);
        
        // IF the client is the Old Version change 8 to 4
        for($i = 0;$i <8-strlen($expansion);++$i)
        {	
			$tmpPacket .= "0";				
		}
        
        $tmpPacket .= $expansion;
        // if (versaoAntiga){
			//Versao antiga o pacote é 3 bytes
		//}else{
			//Versao nova o pacote tem 5 bytes
		//}
		
        $packet = "B9";
        $packet .= $tmpPacket;
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Send the account characters list to the client
     */
    public function sendCharacterList($runInLot = false) {
        $characters        = $this->characters;
        $startingLocations = UltimaPHP::$starting_locations;

        $charLimit = 7;
        $tmpPacket = "";

        for ($i = 0; $i < $charLimit; $i++) {
            if ($i < count($characters)) {
                $tmpPacket .= str_pad((isset($characters[$i]) ? Functions::strToHex($characters[$i]['name']) : 0), 60, "0", STR_PAD_RIGHT);
                $tmpPacket .= str_pad("00", 60, "0", STR_PAD_RIGHT);
            } else {
                $tmpPacket .= str_pad("00", 120, "0", STR_PAD_RIGHT);
            }
        }
        $tmpPacket .= str_pad(dechex(count($startingLocations)), 2, "0", STR_PAD_LEFT);

        foreach ($startingLocations as $key => $location) {
            // If Client version is bigger then 7.0.13.0
            $tmpPacket .= str_pad(dechex($key + 1), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(Functions::strToHex($location['name'])), 64, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(strtoupper(Functions::strToHex($location['area'])), 64, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['x'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['y'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['z'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['map'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['clioc'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad("", 8, "0", STR_PAD_RIGHT);


            /*if (isset(UltimaPHP::$socketClients[$this->client]['version']) && UltimaPHP::$socketClients[$this->client]['version']['major'] >= 7 && UltimaPHP::$socketClients[$this->client]['version']['minor'] >= 0 && UltimaPHP::$socketClients[$this->client]['version']['revision'] >= 13 && UltimaPHP::$socketClients[$this->client]['version']['prototype'] >= 0) {

            $tmpPacket .= str_pad(dechex($key + 1), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(Functions::strToHex($location['name']), 64, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(Functions::strToHex($location['area']), 64, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['x'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['y'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['z'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['position']['map'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(strtoupper(dechex($location['clioc'])), 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad("", 8, "0", STR_PAD_RIGHT);
            } else {
            $tmpPacket .= str_pad(dechex($key + 1), 2, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(Functions::strToHex($location['name']), 62, "0", STR_PAD_RIGHT);
            $tmpPacket .= str_pad(Functions::strToHex($location['area']), 62, "0", STR_PAD_RIGHT);
            }*/
        }
		
        $tmpPacket .= str_pad("11E8", 8, "0", STR_PAD_LEFT);
        $tmpPacket .= "FFFF";

        $packet = "A9";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 4), 4, "0", STR_PAD_LEFT);
        $packet .= "07"; // CharLimit $packet[3]
        $packet .= $tmpPacket;

        $version = Functions::getClientVersion($this->client);
        
        Sockets::out($this->client, $packet, $runInLot);
    }

    /**
     * Process the character login request
     */
    public function loginCharacter($info = array()) {
        if (isset($this->characters[$info['slotchoosen']])) {
            $this->player = new Player($this->client, $this->characters[$info['slotchoosen']]['serial']);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "sendClientLocaleBody",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "drawPlayer",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "updateStatusBar",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "enableMapDiffs",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "updateCursorColor",
                "args"   => 0,
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "mountSpeed",
                "args"   => 0,
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "statusBarInfo",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "extendedStats",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "confirmLogin",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setWarMode",
                "args"   => 0,
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setSeasonal",
                "args"   => array(0, true),
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setWeather",
                "args"   => array(255, 0, 16),
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setLight",
                "args"   => 2,
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "setTime",
            ), 0.0, true);
            Sockets::addEvent($this->client, array(
                "option" => "player",
                "method" => "playMusic",
                "args"   => 29,
            ), 0.0, true, true);
            Sockets::addEvent($this->client, array(
                "option" => "map",
                "method" => "updatePlayerLocation",
                "args"   => $this->client,
            ), 0.2, false);
        } else {
            $this->disconnect(4);
        }
    }        

    /**
     * Send the connection confirmation of selected server
     */
    public function sendConnectionConfirmation($runInLot = false) {
        if (isset(UltimaPHP::$socketClients[$this->client]['connected_server'])) {
            $ip = explode(".", UltimaPHP::$servers[UltimaPHP::$socketClients[$this->client]['connected_server']]['ip']);

            $packet = "8C";
            $packet .= str_pad(dechex($ip[0]), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($ip[1]), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($ip[2]), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex($ip[3]), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(UltimaPHP::$servers[UltimaPHP::$socketClients[$this->client]['connected_server']]['port']), 4, "0", STR_PAD_LEFT);

            $packet .= str_pad(dechex(UltimaPHP::$socketClients[$this->client]['version']['major']), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(UltimaPHP::$socketClients[$this->client]['version']['minor']), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(UltimaPHP::$socketClients[$this->client]['version']['revision']), 2, "0", STR_PAD_LEFT);
            $packet .= str_pad(dechex(UltimaPHP::$socketClients[$this->client]['version']['prototype']), 2, "0", STR_PAD_LEFT);

            Sockets::out($this->client, $packet, $runInLot);
        } else {
            $this->disconnect(4);
        }
    }

    /**
     * Disconnect account from server
     *
     * Reasons:
     * 0 - Incorrect namae/password.
     * 1 - Someone is already using this account.
     * 2 - Your account has been blocked.
     * 3 - Your account credentials are invalid.
     * 4 - Communication problem. [DEFAULT]
     * 5 - The IGR concurrency limit has been met.
     * 6 - The IGR time limit has been met.
     * 7 - General IGR authentication failure.
     */
    public function disconnect($reason = 4) {
        $packet = chr(130) . chr(hexdec($reason));
        UltimaPHP::log("Client " . UltimaPHP::$socketClients[$this->client]['ip'] . " disconnected from the server");
        Sockets::out($this->client, $packet, false, true, true);
    }

    public function sendClientVersionRequest($runInLot = false) {
        Sockets::out($this->client, "BD0003", $runInLot);
    }
    
    public function createCharacter70160($runInLot = false, $charName, $flags, $loginCount, $profession, $genderRace, $str, $dex, $int, $skillid1,$skillvalue1, $skillid2, $skillvalue2, $skillid3, $skillvalue3, $skillid4, $skillvalue4 , $skinColor, $hairStyle, $beardStyle, $beardColor, $shardIndex, $startCity, $charSlot, $shirtColor, $pantsColor){
		//Ainda nao fiz			
		
		$female = TRUE;
		$tRace = 0;
		$body = 400;
		
		if(($genderRace % 2) != 0)
		{
			$female = FALSE;
		}
				
		if ($genderRace <= 3)
		{
			$tRace = 0;		// Its a Human!		
			if($female)
			{
				$body = 401;
			}
			else
			{
				$body = 400;
			}
		}
		else if ($genderRace > 3 && $genderRace < 6)
		{		
			$tRace = 1;			// Its a Elf!
			if($female)
			{
				$body = 606;
			}
			else
			{
				$body = 606;
			}
		}
		else
		{		
			$tRace = 2;		// Its a Gargoyle!
			if($female)
			{
				$body = 667;
			}
			else
			{
				$body = 666;
			}
		}
		
		$statSum = $str + $dex + $int;
		
		// Every stat needs to be below 60 && the sum lower/equal than 80
		if ($statSum > 90 || ($str > 60) || ($dex > 60) || ($int > 60))
		{
			echo "Submitted invalid stats during char creation (".$str.",".$dex.",".$int.").\n";			
		}		

        
	}
}