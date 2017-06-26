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
        } else {
            UltimaPHP::$socketClients[$this->client]['account']->disconnect(3);
        }

        return true;
    }
}