<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Sockets {
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
			UltimaPHP::setStatus(UltimaPHP::STATUS_LISTENING, array(
				UltimaPHP::$conf['server']['ip'],
				UltimaPHP::$conf['server']['port'],
			));
		} else {
			UltimaPHP::log("Server could not listen on " . UltimaPHP::$conf['server']['ip'] . " at port " . UltimaPHP::$conf['server']['port'], UltimaPHP::LOG_DANGER);
			UltimaPHP::stop();
		}
		socket_listen(UltimaPHP::$socketServer);
	}

	public static function monitor() {
		$microtime = microtime(true);
		if (UltimaPHP::$socketClients[(string) $microtime]['socket'] = @socket_accept(UltimaPHP::$socketServer)) {

			// Create the socket between the client and the server
			$id = (string) $microtime;
			socket_getpeername(UltimaPHP::$socketClients[$id]['socket'], UltimaPHP::$socketClients[$id]['ip'], UltimaPHP::$socketClients[$id]['port']);
			UltimaPHP::$socketClients[$id]['LastInput'] = $microtime;
			UltimaPHP::$socketClients[$id]['packets'] = array();
			UltimaPHP::$socketClients[$id]['compressed'] = false;
		}

		foreach (UltimaPHP::$socketClients as $client => $socket) {
			if (isset($socket) && isset($socket['socket']) && null != $socket['socket']) {
				$input = @socket_read($socket['socket'], 8192);

				if (strlen($input) > 0) {
					UltimaPHP::$socketClients[$client]['LastInput'] = $microtime;

					if (!isset(UltimaPHP::$socketClients[$client]['version']) && ord($input[0]) == UltimaPHP::$conf['server']['client']['major'] && ord($input[1]) == UltimaPHP::$conf['server']['client']['minor'] && ord($input[2]) == UltimaPHP::$conf['server']['client']['revision'] && ord($input[3]) == UltimaPHP::$conf['server']['client']['prototype']) {
						self::in(Functions::strToHex($input), $client, true);
					} else {
						$validation = self::validatePacket(str_split(Functions::strToHex($input), 2));
						if (false !== $validation) {
							foreach ($validation as $packetArray) {
								self::in(implode("", $packetArray), $client);
							}
						} else {
							echo "Invalid packet received: " . Functions::strToHex($input) . "\n";
						}
					}
				}

				foreach ($socket['packets'] as $packet_id => $packet) {
					if ($packet['time'] <= $microtime) {
						$err = null;
						socket_write($socket['socket'], $packet['packet']) or $err = socket_last_error(UltimaPHP::$socketClients[$client]['socket']);

						// Release the socket from server after send disconnect packet
						if (dechex(ord($packet['packet'][0])) == 82) {
							unset(UltimaPHP::$socketClients[$client]);
						}
						if (null === $err) {
							unset(UltimaPHP::$socketClients[$client]['packets'][$packet_id]);
						}
					}
				}
			}
		}
	}

	private static function in($input, $client, $firstConnectionPacket = false) {

		// Handler merged packets received from the first communiction between server and cleint after the client connect to a server
		if (true === $firstConnectionPacket) {
			$packet = "packet_0x1";
		} else {
			$packet = "packet_0x" . strtoupper(substr($input, 0, 2));
		}

		if (method_exists("Packets", $packet)) {
			Packets::$packet(str_split($input, 2), $client);
		} else {
			UltimaPHP::log("Client sent an unknow packet 0x" . strtoupper(substr($input, 0, 2)) . " to the server:", UltimaPHP::LOG_WARNING);
			UltimaPHP::log("Packet received: " . $input, UltimaPHP::LOG_NORMAL);
		}
	}

	public static function out($client, $packet, $prefix = null, $dontConvert = false, $dontCompress = false) {
		$err = null;

		if (false === $dontCompress && isset(UltimaPHP::$socketClients[$client]['compressed']) && true === UltimaPHP::$socketClients[$client]['compressed']) {
			$compression = new Compression();
			$packet = unpack('H*', $compression->compress(strtoupper($packet)))[1];
		}

		if (false === $dontConvert) {
			$packet = Functions::hexToChr($packet);
		} else {
			$packet = $packet;
		}

		if (null !== $prefix) {
			$packet = $prefix . $packet;
		}

		if (true === UltimaPHP::$conf['logs']['debug']) {
			echo "Sending packet: " . Functions::strToHex($packet) . "\n\n";
		}

		UltimaPHP::$socketClients[$client]['packets'][] = array(
			'packet' => $packet,
			'time' => (microtime(true) + 0.00100),
		);
	}

	public static function addEvent($client, $event, $time) {
		$mt = microtime(true);
		if (!is_array($event)) {
			UltimaPHP::log("Unknow event was send to the server.", UltimaPHP::LOG_WARNING);
			return false;
		} else {
			UltimaPHP::$socketEvents[$mt][] = array(
				'event' => $event,
				'client' => $client,
				'time' => ($mt + $time),
			);
			return true;
		}
	}

	public static function runEvents() {
		$mt = microtime(true);
		foreach (UltimaPHP::$socketEvents as $registerTime => $events) {
			foreach ($events as $eventKey => $event) {
				if ($mt >= $event['time']) {
					$args = (isset($event['event']['args']) ? $event['event']['args'] : array());
					UltimaPHP::$socketClients[$event['client']]['account']->$event['event']['option']->$event['event']['method']($args);
					unset(UltimaPHP::$socketEvents[$registerTime][$eventKey]);
				}
			}
		}
	}

	public static function validatePacket($inputArray = array()) {
		if (count($inputArray) == 0) {
			return false;
		}
		$return = array();
		if (isset(Packets::$packets[hexdec($inputArray[0])])) {
			$expectedLength = Packets::$packets[hexdec($inputArray[0])];

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
				$length = hexdec($inputArray[1] . $inputArray[2]);

				$return[] = array_slice($inputArray, 0, $length);
				$next = self::validatePacket(array_slice($inputArray, $length));
				if (false !== $next) {
					foreach ($next as $key => $value) {
						$return[] = $value;
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
}
?>