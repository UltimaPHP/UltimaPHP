<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Sockets {
    static $socketsTotal = 0;
    /**
     * The socket server constructor!
     * This method creates an socket to listen the choosen port to monitor ultima online communication
     */
    public function __construct() {
        // Create a TCP Stream socket
        // if (false == (UltimaPHP::$socketServer = @socket_create(AF_INET, SOCK_STREAM, 0))) {
        if (false == (UltimaPHP::$socketServer = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP))) {
            UltimaPHP::log("Could not start socket listening.", UltimaPHP::LOG_DANGER);
            UltimaPHP::stop();
        }

        if (!socket_set_nonblock(UltimaPHP::$socketServer)) {
            echo "???";
        }

        if (socket_bind(UltimaPHP::$socketServer, UltimaPHP::$conf['server']['ip'], UltimaPHP::$conf['server']['port'])) {
            UltimaPHP::setStatus(UltimaPHP::STATUS_LISTENING, array(
                UltimaPHP::$conf['server']['ip'],
                UltimaPHP::$conf['server']['port'],
            ));
        } else {
            UltimaPHP::log("Server could not listen on " . UltimaPHP::$conf['server']['ip'] . " at port " . UltimaPHP::$conf['server']['port'], UltimaPHP::LOG_DANGER);
            UltimaPHP::stop();
        }

        socket_listen(UltimaPHP::$socketServer, UltimaPHP::$conf['server']['max_players']);
    }

    /**
     * Method called every tick of the server to monitor the incoming/outgoing data from sockets
     */
    public static function monitor() {
        $microtime = microtime(true);
        if ($socket = @socket_accept(UltimaPHP::$socketServer)) {
            $timeout = array('sec' => 0.1, 'usec' => 1000);
            socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, $timeout);

            self::$socketsTotal++;
            $id = self::$socketsTotal;

            UltimaPHP::$socketClients[$id]['socket'] = $socket;
            // Create the socket between the client and the server
            socket_getpeername(UltimaPHP::$socketClients[$id]['socket'], UltimaPHP::$socketClients[$id]['ip'], UltimaPHP::$socketClients[$id]['port']);

            UltimaPHP::$socketClients[$id]['LastInput'] = $microtime;
            UltimaPHP::$socketClients[$id]['packets'] = [];
            UltimaPHP::$socketClients[$id]['compressed'] = false;
            UltimaPHP::$socketClients[$id]['packetLot'] = null;
            UltimaPHP::$socketClients[$id]['version'] = null;
            UltimaPHP::$socketClients[$id]['tempSeed'] = null;
        }

        foreach (UltimaPHP::$socketClients as $client => $socket) {
            // Socket Killer
            if ($microtime - UltimaPHP::$socketClients[$client]['LastInput'] > UltimaPHP::$conf['server']['socketTimeout']) {
                if (isset(UltimaPHP::$socketClients[$client]['account'])) {
                    UltimaPHP::$socketClients[$client]['account']->disconnect(RejectionReason::COMMUNICATION_PROBLEM);
                }

                unset(UltimaPHP::$socketClients[$client]);

                if (UltimaPHP::$conf['logs']['debug']) {
                    UltimaPHP::log("Socket {$client} disconnected.", UltimaPHP::LOG_WARNING);
                }
                continue;
            }

            if (isset($socket) && isset($socket['socket']) && null != $socket['socket']) {
                foreach ($socket['packets'] as $packet_id => $packet) {
                    if ($packet['time'] <= $microtime) {
                        if (UltimaPHP::$conf['logs']['debug']) {
                            $packetTemp = Functions::strToHex($packet['packet']);

                            if (isset($socket['compressed']) && $socket['compressed'] === true) {
                                $compression = new Compression();
                                $decompressed = implode("", $compression->decompress(strtoupper($packetTemp)));
                                $packet_cmd = strtoupper(substr($decompressed, 0, 2));
                                echo "----------------------------------------------\nSending compressed packet 0x" . $packet_cmd . " to socket #$client (Length: " . (strlen($decompressed) / 2) . ") :: " . $decompressed . "\n----------------------------------------------\n";
                            } else {
                                $packet_cmd = strtoupper(substr($packetTemp, 0, 2));
                                echo "----------------------------------------------\nSending packet 0x" . $packet_cmd . " to socket #$client (Length: " . (strlen($packetTemp) / 2) . ") :: " . $packetTemp . "\n----------------------------------------------\n";
                            }
                        }

                        $err = null;
                        @socket_write($socket['socket'], $packet['packet']) or $err = socket_last_error($socket['socket']);

                        if ($err === null) {
                            unset(UltimaPHP::$socketClients[$client]['packets'][$packet_id]);
                        }

                        // Release the socket from server after send disconnect packet
                        if (!isset($packet['packet'][0])|| dechex(ord($packet['packet'][0])) == 82) {
                            unset(UltimaPHP::$socketClients[$client]);
                            continue 2;
                        }
                    }
                }

                $input = "";
                @socket_recv($socket['socket'], $input, 4096, (PHP_OS == "Linux" ? MSG_WAITALL : 0));

                $buffer = ($input ? str_split(Functions::strToHex($input), 2) : false);
                $length = ($buffer ? count($buffer) : 0);

                if ($buffer) {
                    /**
                     * 0xEF - First socket connection packet fix
                     */
                    if ($socket['version'] === null) {
                        // Single 0xEF packet receiving skipping
                        if ($buffer[0] == "EF" && $length == 1) {
                            continue;
                        }

                        // When the second bytestrem received, adds the 0xEF to the packet start
                        if (($length == 20 && ($buffer[0] != 0xEF && $buffer[0] != "EF")) ||  $length == 82){
                            array_unshift($buffer, "EF");
                        }
                    }

                    if ($length == 69 && hexdec($buffer[4]) == 0x91) {
                        UltimaPHP::$socketClients[$client]['tempSeed'] = hexdec(implode("", array_slice($buffer, 0, 4)));
                        $buffer = array_slice($buffer, 4);
                        $length = 65;

                        UltimaPHP::$socketClients[$client]['LastInput'] = $microtime;
                        self::in($buffer, $client);
                        continue;
                    }

                    // If player isn't relayed and not tested for encryption
                    if ($socket['version'] !== null && is_array($socket['version']) && isset($socket['version']['encrypted'])) {
                        if (UltimaPHP::$conf['logs']['debug'] === true) {
                            echo "Handling encryption\n";
                            print_r($socket['version']);
                        }

                        if ($socket['version']['encrypted'] === null) {
                            if ($buffer[0] == 0x80 || $buffer[0] == "80") {
                                UltimaPHP::log("Client tries to connect using know unecrypted client version.", UltimaPHP::LOG_WARNING);
                                UltimaPHP::$socketClients[$client]['version']['encrypted'] = false;
                            } else {
                                $converted = Encrypt::decryptPacket($buffer, $socket['version']);

                                if (UltimaPHP::$conf['logs']['debug'] === true) {
                                    echo "converted 1:\n\n";
                                    echo "Buffer:" . implode("", $buffer) . "\n";
                                    echo "Decrypted:" . implode("", $converted) . "\n";
                                }

                                if (hexdec($converted[0]) != 0x80) {
                                    UltimaPHP::log("Client tries to connect using unknow client version.", UltimaPHP::LOG_WARNING);
                                    UltimaPHP::$socketClients[$client]['account']->disconnect(RejectionReason::COMMUNICATION_PROBLEM);
                                    continue;
                                }

                                $buffer = $converted;
                                UltimaPHP::$socketClients[$client]['version']['encrypted'] = true;
                            }
                        }

                        if ($socket['version']['encrypted'] === null && hexdec($buffer[0]) == 0x80) {
                            UltimaPHP::$socketClients[$client]['version']['encrypted'] = false;
                        }
                    }

                    if (isset($socket['version']) && isset($socket['version']['encrypted']) && $socket['version']['encrypted'] === true) {
                        if (UltimaPHP::$conf['logs']['debug'] === true) {
                            echo "converted 2:\n\n";
                            echo "Buffer:" . implode("", $buffer) . "\n";
                        }
                        $buffer = Encrypt::decryptPacket($buffer, $socket['version']);
                        if (UltimaPHP::$conf['logs']['debug'] === true) {
                            echo "Decrypted:" . implode("", $buffer) . "\n";
                        }
                    }

                    $validation = self::validatePacket($buffer);

                    if ($validation !== false) {
                        UltimaPHP::$socketClients[$client]['LastInput'] = $microtime;
                        foreach ($validation as $packetArray) {
                            self::in($packetArray, $client);
                        }
                    } else {
                        echo "Invalid packet received: " . Functions::strToHex($input) . "\n";
                    }
                }
            }
        }
    }

    /**
     * Incoming packet handler
     */
    private static function in($input, $client) {
        $packetMethod = "packet_0x" . $input[0];

        if (class_exists($packetMethod)) {
            if (true === UltimaPHP::$conf['logs']['debug']) {
                echo "----------------------------------------------\nReceived packet 0x" . strtoupper($input[0]) . " from socket #$client (Length: " . count($input) . ") :: " . implode("", $input) . "\n----------------------------------------------\n";
            }

            $packet = new $packetMethod($client);
            $packet->receive($input);
        } else {
            echo "----------------------------------------------\nReceived unknow packet 0x" . strtoupper($input[0]) . " from socket #$client (Length: " . count($input) . ") :: " . implode("", $input) . "\n----------------------------------------------\n";
        }
    }

    /**
     * Outgoing packet handler
     */
    public static function out($client, $packet, $lot = array(), $dontConvert = false, $dontCompress = false) {
        $err = null;

        if (is_object($packet)) {
            $packet = $packet->getPacketStr();
        }

        if (false === $dontCompress && isset(UltimaPHP::$socketClients[$client]['compressed']) && true === UltimaPHP::$socketClients[$client]['compressed']) {
            $compression = new Compression();
            $packet = unpack('H*', $compression->compress(strtoupper($packet)))[1];
        }

        if (false === $dontConvert) {
            $packet = Functions::hexToChr($packet);
        }

        if (is_array($lot) && count($lot) == 2 && isset($lot[0]) && isset($lot[1]) && true === $lot[0] && $lot[1] === false) {
            UltimaPHP::$socketClients[$client]['packetLot'] .= $packet;
            $packet = null;
        } else if (is_array($lot) && count($lot) == 2 && isset($lot[0]) && isset($lot[1]) && true === $lot[0] && $lot[1] === true) {
            $packet = UltimaPHP::$socketClients[$client]['packetLot'] . $packet;
            UltimaPHP::$socketClients[$client]['packetLot'] = null;
        }

        if ($packet !== null) {
            UltimaPHP::$socketClients[$client]['packets'][] = array(
                'packet' => $packet,
                'time' => (microtime(true) + 0.00100),
            );
        }

        return true;
    }

    /**
     * Register an $event to run in $client after $time seconds.
     *
     */
    public static function addEvent($client, $event, $time, $runInLot = false, $dispatchLot = false) {
        $mt = microtime(true);
        if (!is_array($event)) {
            UltimaPHP::log("Unknow event was send to the server.", UltimaPHP::LOG_WARNING);
            return false;
        } else {
            UltimaPHP::$socketEvents[$mt][] = array(
                'event' => $event,
                'client' => $client,
                'time' => ($mt + $time),
                'lot' => array(
                    $runInLot,
                    $dispatchLot,
                ),
            );
            return true;
        }
    }

    /**
     * Register an $event to run in $client after $time seconds.
     *
     */
    public static function addSerialEvent($serial, $event, $time) {
        $mt = microtime(true);
        if (!is_array($event)) {
            UltimaPHP::log("Unknow event was send to the server.", UltimaPHP::LOG_WARNING);
            return false;
        } else {
            UltimaPHP::$socketEvents[$mt][] = array(
                'event' => $event,
                'serial' => $serial,
                'time' => ($mt + $time),
                'lot' => array(
                    false,
                    false,
                ),
            );
            return true;
        }
    }

    public static function removeAllSerialEvents($serial, $event) {
        foreach (UltimaPHP::$socketEvents as $time => $ev) {
            if (isset($ev['serial']) && $ev['serial'] == $serial && $ev['event']['option'] == $event['option'] && $ev['event']['method'] == $event['method']) {
                unset(UltimaPHP::$socketEvents[$time]);
            }
        }
    }

    /**
     * Method called on every server tick to trigger registered events on the right time
     */
    public static function runEvents() {
        $mt = microtime(true);
        foreach (UltimaPHP::$socketEvents as $registerTime => $events) {
            foreach ($events as $eventKey => $event) {
                if ($mt >= $event['time']) {
                    $args = (isset($event['event']['args']) ? $event['event']['args'] : array());

                    $method = $event['event']['method'];
                    $option = $event['event']['option'];

                    if ($event['event']['option'] == "account") {
                        UltimaPHP::$socketClients[$event['client']]['account']->$method($event['lot'], $args);
                    } else if ($event['event']['option'] == "map") {
                        Map::$method($args);
                    } else if ($event['event']['option'] == "mobile") {
                        $instance = Map::getBySerial($event['serial']);
                        $instance->$method($args);
                    } else {
                        UltimaPHP::$socketClients[$event['client']]['account']->$option->$method($event['lot'], $args);
                    }

                    unset(UltimaPHP::$socketEvents[$registerTime][$eventKey]);
                }
            }
        }
    }

    /**
     * Validates the "packet string" received/sent and return a multi-dimensional array of splited "packets"
     */
    public static function validatePacket($inputArray = array()) {
        if (count($inputArray) == 0) {
            return false;
        }
        $return = array();
        if (isset(PacketsDefs::LENGTH[hexdec($inputArray[0])])) {
            $expectedLength = PacketsDefs::LENGTH[hexdec($inputArray[0])];

            if ($expectedLength > 0) {
                if (count($inputArray) > $expectedLength) {
                    $return[] = array_slice($inputArray, 0, $expectedLength);
                    $next = self::validatePacket(array_slice($inputArray, $expectedLength));
                    if (false !== $next) {
                        foreach ($next as $key => $value) {
                            $return[] = $value;
                        }
                    }
                } elseif (count($inputArray) == $expectedLength) {
                    $return[] = $inputArray;
                } else {
                    return false;
                }
            } elseif (-1 == $expectedLength) {
                // The packet have the information of lenth
                if (isset($inputArray[1]) && isset($inputArray[2])) {
                    $length = hexdec($inputArray[1] . $inputArray[2]);

                    $return[] = array_slice($inputArray, 0, $length);
                    $next = self::validatePacket(array_slice($inputArray, $length));
                    if (false !== $next) {
                        foreach ($next as $key => $value) {
                            $return[] = $value;
                        }
                    }
                }
            } elseif (false === $expectedLength) {
                $return[] = $inputArray;
            }
        } else {
            return false;
        }

        return $return;
    }

    public static function removeSerialFromEverybodyView($serial) {
        foreach (UltimaPHP::$socketClients as $client => $socket) {
            if (isset(UltimaPHP::$socketClients[$client]['account']) && isset(UltimaPHP::$socketClients[$client]['account']->player)) {
                if (UltimaPHP::$conf['logs']['debug']) {
                    UltimaPHP::log("Removing {$serial} from player " . UltimaPHP::$socketClients[$client]['account']->player->serial, UltimaPHP::LOG_WARNING);
                }

                UltimaPHP::$socketClients[$client]['account']->player->removeObjectFromView($serial);
            }
        }
    }
}