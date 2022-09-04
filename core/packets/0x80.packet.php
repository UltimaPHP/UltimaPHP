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

	private function insertAccount($account, $password) {
		$dbLastSerial = UltimaPHP::$db->collection("accounts")->find([], ['projection' => ['serial' => true], 'sort' => ['serial' => -1], 'limit' => 1])->toArray();
		$nextSerial   = ((int) $dbLastSerial[0]['serial'] + 1);

		$obj = [
			'account'       => $account,
			'password'      => $password,
			'serial'        => $nextSerial,
			'creationDate'  => date("d-m-Y H:i:s "),
			'maxChars'      => UltimaPHP::$conf['accounts']['max_chars'],
			'lastLogin'     => false,
			'plevel'        => 1,
			'status'        => 1,
			'clientVersion' => null,
		];
		UltimaPHP::$db->collection("accounts")->insertOne($obj);
	}

	private function insertClientVersion($account = null) {
		$result = UltimaPHP::$db->collection("accounts")->find(['account' => $account])->toArray();

		if ($result === null) {
			return false;
		}

		UltimaPHP::$db->collection("accounts")->updateOne(['account' => $account], ['$set' => ['clientVersion' => UltimaPHP::$socketClients[$this->client]['version']]]);

		return true;

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

		// Account / Password validadion
		$test = UltimaPHP::$db->collection("accounts")->find(['account' => $account])->toArray();
		if (!empty($test[0]) && md5($password) != $test[0]['password']) {
			// Send disconnect packet without account instance
			$packet = new packet_0x82($this->client);
	        $packet->setReason(RejectionReason::WRONG_PASSWORD);
	        $packet->send();
	        
			UltimaPHP::log("Account $account tried to login with wrong password.");
			return false;
		}

		UltimaPHP::$socketClients[$this->client]['account'] = array(
			'account'  => $account,
			'password' => md5($password),
		);

		UltimaPHP::$socketClients[$this->client]['account'] = new Account($account, md5($password), $this->client);

		if (UltimaPHP::$socketClients[$this->client]['account']->isValid) {
			// Verify if account is already in use
			$inUse = false;
			foreach (UltimaPHP::$socketClients as $client => $socket) {
				if ($this->client != $client) {
					if (isset($socket['account']) && isset($socket['account']->account) && $socket['account']->account == UltimaPHP::$socketClients[$this->client]['account']->account) {
						$inUse = true;
					}
				}
			}
			if ($inUse) {
				UltimaPHP::$socketClients[$this->client]['account']->disconnect(RejectionReason::ACCOUNT_IN_USE);
				UltimaPHP::log("Account $account already connected.");
				return false;
			}
			UltimaPHP::log("Account $account connected from " . UltimaPHP::$socketClients[$this->client]['ip']);
			// Send to the client the server list
			UltimaPHP::$socketClients[$this->client]['account']->sendServerList();
		} elseif (UltimaPHP::$conf['accounts']['auto_create'] == 1) {
			$this->insertAccount($account, md5($password));
			$this->receive($data);
		} else {
			UltimaPHP::$socketClients[$this->client]['account']->disconnect(RejectionReason::WRONG_PASSWORD);
		}
		$this->insertClientVersion($account);

		return true;
	}
}