<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Sockets
{
    function __construct() {
        
        // Create a TCP Stream socket
        if (false == (UltimaPHP::$socketServer = @socket_create(AF_INET, SOCK_STREAM, 0))) {
            UltimaPHP::log("Could not start socket listening.", UltimaPHP::LOG_DANGER);
            UltimaPHP::stop();
        }
        
        if (!socket_set_nonblock(UltimaPHP::$socketServer)) {
            echo "???";
        }
        
        if (socket_bind(UltimaPHP::$socketServer, UltimaPHP::$conf['server']['ip'], UltimaPHP::$conf['server']['port'])) {
            UltimaPHP::setStatus(UltimaPHP::STATUS_LISTENING, array(UltimaPHP::$conf['server']['ip'], UltimaPHP::$conf['server']['port']));
        } 
        else {
            UltimaPHP::log("Server could not listen on " . UltimaPHP::$conf['server']['ip'] . " at port " . UltimaPHP::$conf['server']['port'], UltimaPHP::LOG_DANGER);
            UltimaPHP::stop();
        }
        socket_listen(UltimaPHP::$socketServer);
    }
    
    public static function monitor() {
        $microtime = microtime(true);
        if (UltimaPHP::$socketClients[(string)$microtime]['socket'] = @socket_accept(UltimaPHP::$socketServer)) {
            
            // Create the socket between the client and the server
            $id = (string)$microtime;
            socket_getpeername(UltimaPHP::$socketClients[$id]['socket'], UltimaPHP::$socketClients[$id]['ip'], UltimaPHP::$socketClients[$id]['port']);
            UltimaPHP::$socketClients[$id]['LastInput'] = $microtime;
            UltimaPHP::$socketClients[$id]['packets'] = array();
            UltimaPHP::$socketClients[$id]['compressed'] = false;
        }
        
        foreach (UltimaPHP::$socketClients as $client => $socket) {
            if (isset($socket) && isset($socket['socket']) && $socket['socket'] != null) {
                $input = @socket_read($socket['socket'], 8192);
                
                if (strlen($input) > 0) {
                    self::in($input, $client);
                    UltimaPHP::$socketClients[$client]['LastInput'] = $microtime;
                }
                
                foreach ($socket['packets'] as $packet_id => $packet) {
                    if ($packet['time'] <= $microtime) {
                        $err = NULL;
                        socket_write($socket['socket'], $packet['packet']) or $err = socket_last_error(UltimaPHP::$socketClients[$client]['socket']);
                        if ($err === NULL) {
                            unset(UltimaPHP::$socketClients[$client]['packets'][$packet_id]);
                        }
                    }
                }
            }
        }
    }
    
    private static function in($input, $client) {
        $packet = "packet_0x" . strtoupper(dechex(ord(substr($input, 0, 1))));
        
        // Fix for capture wrong packets received from client
        if (strlen(strtoupper(dechex(ord(substr($input, 0, 1))))) == 1) {
            $packet = "packet_0x1";
        }
        
        $len = strlen($input);
        $data = dechex(ord(substr($input, 0, 1)));
        
        for ($i = 1; $i <= $len; $i++) {
            $ch = dechex(ord(substr($input, $i, 1)));
            
            if (strlen($ch) < 2) {
                $data.= " 0$ch";
            } 
            else {
                $data.= " $ch";
            }
        }
        
        if (method_exists("Packets", $packet)) {
            Packets::$packet(explode(" ", $data), $client);
        } 
        else {
            UltimaPHP::log("Client sent an unknow packet 0x" . strtoupper(dechex(ord(substr($input, 0, 1)))) . " to the server:", UltimaPHP::LOG_WARNING);
            UltimaPHP::log("Packet received: " . $data, UltimaPHP::LOG_NORMAL);
        }
    }
    
    public static function out($client, $packet, $dontConvert = false) {
        $err = NULL;
        
        if (isset(UltimaPHP::$socketClients[$client]['compressed']) && UltimaPHP::$socketClients[$client]['compressed'] === true) {
            $compression = new Compression();
            $packet = "B30CEC99E8D0" . unpack('H*', $compression->compress($packet)) [1];
        }
        
        if ($dontConvert === false) {
            $packet = Functions::hexToChr($packet);
        } 
        else {
            $packet = $packet;
        }
        
        UltimaPHP::$socketClients[$client]['packets'][] = array('packet' => $packet, 'time' => (microtime(true) + 0.00100));
    }
    
    public static function addEvent($client, $event, $time) {
        $mt = microtime(true);
        if (!is_array($event)) {
            UltimaPHP::log("Unknow event was send to the server.", UltimaPHP::LOG_WARNING);
            return false;
        } 
        else {
            UltimaPHP::$socketEvents[$mt] = array('event' => $event, 'client' => $client, 'time' => ($mt + $time));
            return true;
        }
    }
    
    public static function runEvents() {
        $mt = microtime(true);
        foreach (UltimaPHP::$socketEvents as $registerTime => $event) {
            if ($mt >= $event['time']) {
                if (class_exists($event['event']['class'])) {
                    if (method_exists($event['event']['class'], $event['event']['method'])) {
                        $event['event']['args'] = (isset($event['event']['args']) ? $event['event']['args'] : array());
                        
                        call_user_func_array(array($event['event']['class'], $event['event']['method']), array("", $event['client'], $event['event']['args']));
                        
                        unset(UltimaPHP::$socketEvents[$registerTime]);
                    } 
                    else {
                        
                        // Event method called don't exists
                        UltimaPHP::log("Event called a invalid method: " . $event['event']['method'] . " from class: " . $event['event']['class'], UltimaPHP::LOG_WARNING);
                        unset(UltimaPHP::$socketEvents[$registerTime]);
                    }
                } 
                else {
                    
                    // Event class called
                    UltimaPHP::log("Event called a invalid class: " . $event['event']['class'], UltimaPHP::LOG_WARNING);
                    unset(UltimaPHP::$socketEvents[$registerTime]);
                }
            }
        }
    }
}
?>