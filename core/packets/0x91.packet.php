<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x91 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x91);

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
        $keyUsed  = hexdec($data[1]) . hexdec($data[2]) . hexdec($data[3]) . hexdec($data[4]);
        $account  = Functions::hexToChr($data, 5, 34, true);
        $password = Functions::hexToChr($data, 35, 64, true);
        $login = false;

        UltimaPHP::$socketClients[$this->client]['account'] = new Account($account, md5($password), $this->client);

        if (UltimaPHP::$socketClients[$this->client]['account']->isValid) {
            UltimaPHP::log("Account $account logged from IP " . UltimaPHP::$socketClients[$this->client]['ip']);
            // Set the flag on the connection to send next packets compressed
            UltimaPHP::$socketClients[$this->client]['compressed'] = true;
            UltimaPHP::$socketClients[$this->client]['account']->enableLockedFeatures();
            UltimaPHP::$socketClients[$this->client]['account']->sendCharacterList();
        } else {
            UltimaPHP::$socketClients[$this->client]['account']->disconnect(RejectionReason::WRONG_PASSWORD);
        }

        return true;
    }
}