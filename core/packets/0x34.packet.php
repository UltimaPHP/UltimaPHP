<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class packet_0x34 extends Packets {

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false) {
        $this->setPacket(0x34);

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

        $command = $data[0];
        $unknow  = $data[1] . $data[2] . $data[3] . $data[4];
        $type    = $data[5];
        $serial  = Functions::implodeByte(6, 9, $data);
        switch ($type) {
            case 0x00:
                // God client ???
                break;
            case 0x04:
                // Client asking to server send the status information to the client
                if ($serial == UltimaPHP::$socketClients[$this->client]['account']->player->serial) {
                    UltimaPHP::$socketClients[$this->client]['account']->player->statusBarInfo();
                } else {
                    $instance = Map::getBySerial($serial);
                    if (!$instance) {
                        return false;
                    }
                    if (method_exists($instance, "statusBarInfo")) {
                        if ($instance->instanceType == UltimaPHP::INSTANCE_PLAYER) {
                            UltimaPHP::$socketClients[$this->client]['account']->player->statusBarInfo(false, $instance->client);
                        } else {
                            $instance->statusBarInfo($this->client);
                        }
                    }
                }
                break;
            case 0x05:
                UltimaPHP::$socketClients[$this->client]['account']->player->sendFullSkillList(false);
                // Client asking to server send the skills information to the client
                break;
            default:
                // Unknow status type received
                break;
        }

        return true;
    }
}