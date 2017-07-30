<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x80 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x80);

        if ($client) {
            $this->client = $client;
        }
    }
    
    private function insertAccount($account, $password)
    {
    	$dbLastSerial = UltimaPHP::$db->collection("accounts")->find([], ['projection' => ['serial' => true], 'sort' => ['serial' => -1], 'limit' => 1			])->toArray();
		$nextSerial   = ((int) $dbLastSerial[0]['serial'] + 1);
		
		$obj = [
			'account' => $account,
			'password' => $password,
			'serial' => $nextSerial,
			'creationDate' => date("d-m-Y H:i:s "),
			'maxChars' => UltimaPHP::$conf['accounts']['max_chars'],
			'lastLogin' => false,
			'plevel' => 1,
			'status' => 1,
		];
		UltimaPHP::$db->collection("accounts")->insertOne($obj);
	}

    /**
     * Handle the packet receive
     */
    public function receive($data) {
        if (!$this->client) {
            return false;
        }

        $command  = $data[0];
        $account  = Functions::hexToChr($data, 1, 30, true);
        $password = Functions::hexToChr($data, 31, 61, true);

        $login = false;

        // Account / Password validadion TODO
        UltimaPHP::$socketClients[$this->client]['account'] = array(
            'account'  => $account,
            'password' => md5($password),
        );

        UltimaPHP::$socketClients[$this->client]['account'] = new Account($account, md5($password), $this->client);

        if (UltimaPHP::$socketClients[$this->client]['account']->isValid) {
            UltimaPHP::log("Account $account connected from " . UltimaPHP::$socketClients[$this->client]['ip']);

            // Send to the client the server list
            UltimaPHP::$socketClients[$this->client]['account']->sendServerList();
        } elseif (UltimaPHP::$conf['accounts']['auto_create'] == 1){
				$this->insertAccount($account, md5($password));
				$this->receive($data);						
			}else{
				UltimaPHP::$socketClients[$this->client]['account']->disconnect(3);					
		}            

        return true;
    }
}