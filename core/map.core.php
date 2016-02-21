<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Map
{

	/**
	 * Map loading variables
	 */
	private static $chunks = [];
	private static $mapSize_x = 7168;
	private static $mapSize_y = 4096;
	private static $chunkSize = 256; // Number in square

	public function __construct() {
		$chunks_x = ceil(self::$mapSize_x / self::$chunkSize);
		$chunks_y = ceil(self::$mapSize_y / self::$chunkSize);

		// Build the array that will store map chunks
		for ($x=0; $x < $chunks_x; $x++) {
			self::$chunks[$x] = array();
			for ($y=0; $y < $chunks_y; $y++) {
				self::$chunks[$x][$y] = array(
					'objects' => array(),
					'players' => array(),
					'npcs' => array()
				);
			}
		}
	}

	/**
	 * Return the chunk number of desired map position
	 */
	public static function getChunk($pos_x = null, $pos_y = null) {
		if ($pos_x === null || $pos_y === null || $pos_x <= 0 || $pos_y <= 0 || $pos_x > self::$mapSize_x || $pos_y > self::$mapSize_y) {
			return false;
		}

		return array(
			'x' => (int) ceil($pos_x / self::$chunkSize),
			'y' => (int) ceil($pos_y / self::$chunkSize)
		);
	}

	/**
	 * Add the player to into the map and store information inside the right chunk
	 */
	public static function addPlayerToMap(Player $player) {
		$chunk = self::getChunk($player->position['x'], $player->position['y']);
		self::$chunks[$chunk['x']][$chunk['y']]['players'][$player->client] = true;
		self::updateChunk($chunk);
		return true;
	}

	/**
	 * 	Add the desired object into the map and store information inside the right chunk
	 */
	public static function addObjectToMap(Object $object, $pos_x, $pos_y, $pos_z, $pos_m) {
		$object->pos_x = $pos_x;
		$object->pos_y = $pos_y;
		$object->pos_z = $pos_z;
		$object->location = "map";

		$chunk = self::getChunk($pos_x, $pos_y);
		self::$chunks[$chunk['x']][$chunk['y']]['objects'][] = $object;
		self::updateChunk($chunk);
		return true;
	}

	public static function updatePlayerLocation($client, $oldPosition = null, $newPosition = null) {
		if ($oldPosition === NULL) {
			$tmp = UltimaPHP::$socketClients[$client]['account']->player;
			$oldPosition = $newPosition = $tmp->position;
			unset($tmp);
		}

		$oldChunk = self::getChunk($oldPosition['x'], $oldPosition['y']);
		$newChunk = self::getChunk($newPosition['x'], $newPosition['y']);

		/* Update the chunk of player, if changed */
		if ($oldChunk['x'] != $newChunk['x'] || $oldChunk['y'] != $newChunk['y']) {
			unset(self::$chunks[$oldChunk['x']][$oldChunk['y']]['players'][$client]);
			self::$chunks[$newChunk['x']][$newChunk['y']]['players'][$client] = true;
		}

		/* Send update packet information for players around player */
		$chunk = self::$chunks[$newChunk['x']][$newChunk['y']];
		$updateRange = array(
			'from' => array('x' => ($newPosition['x'] - 10), 'y' => ($newPosition['y'] - 10)),
			'to' => array('x' => ($newPosition['x'] + 10), 'y' => ($newPosition['y'] + 10))
		);

		$actual_player = UltimaPHP::$socketClients[$client]['account']->player;

		foreach ($chunk['players'] as $client_id => $alive) {
			$player = UltimaPHP::$socketClients[$client_id]['account']->player;

			if ($actual_player->serial != $player->serial && $player->position['x'] >= $updateRange['from']['x'] && $player->position['x'] <= $updateRange['to']['x'] && $player->position['y'] >= $updateRange['from']['y'] && $player->position['y'] <= $updateRange['to']['y']) {
				if (!array_key_exists($client_id, $actual_player->mapRange['players'])) {
					$actual_player->mapRange['players'][$client_id] = true;
					$actual_player->drawChar(false, $client_id);
				}
				$actual_player->updatePlayer($client_id);

				if (!array_key_exists($actual_player->client, $player->mapRange['players'])) {
					$player->mapRange['players'][$actual_player->client] = true;
					$player->drawChar(false, $actual_player->client);
				}
				$player->updatePlayer($client);
			} else {
				if (isset($actual_player->mapRange['players'][$player->client])) {
					unset($actual_player->mapRange['players'][$player->client]);
				}
				if (isset($player->mapRange['players'][$actual_player->client])) {
					unset($player->mapRange['players'][$actual_player->client]);
				}
			}
		}
	}

	public static function sendSpeechPacket($packet = null, $client) {
		if ($packet === null) {
			return false;
		}

		$actual_player = UltimaPHP::$socketClients[$client]['account']->player;

		$chunkInfo = self::getChunk($actual_player->position['x'], $actual_player->position['y']);
		$chunk = self::$chunks[$chunkInfo['x']][$chunkInfo['y']];

		$updateRange = array(
			'from' => array('x' => ($actual_player->position['x'] - 10), 'y' => ($actual_player->position['y'] - 10)),
			'to' => array('x' => ($actual_player->position['x'] + 10), 'y' => ($actual_player->position['y'] + 10))
		);

		foreach ($chunk['players'] as $client_id => $alive) {
			$player = UltimaPHP::$socketClients[$client_id]['account']->player;

			if ($actual_player->serial != $player->serial && $player->position['x'] >= $updateRange['from']['x'] && $player->position['x'] <= $updateRange['to']['x'] && $player->position['y'] >= $updateRange['from']['y'] && $player->position['y'] <= $updateRange['to']['y']) {
				Sockets::out($client_id, $packet, false);
			}
		}		
	}

	public static function updateChunk($chunk) {
		$chunk = self::$chunks[$chunk['x']][$chunk['y']];
		
		/* Update items on map */
		foreach ($chunk['objects'] as $object) {
			$packet = "F3";
			$packet .= "0001";
			$packet .= "00";
			$packet .= $object->serial;
			$packet .= str_pad(dechex($object->graphic), 4, "0", STR_PAD_LEFT);
			$packet .= "00";
			$packet .= str_pad(dechex($object->amount), 4, "0", STR_PAD_LEFT);
			$packet .= str_pad(dechex($object->amount), 4, "0", STR_PAD_LEFT);
			$packet .= str_pad(dechex($object->pos_x), 4, "0", STR_PAD_LEFT);
			$packet .= str_pad(dechex($object->pos_y), 4, "0", STR_PAD_LEFT);
			$packet .= str_pad("00", 2, "0", STR_PAD_LEFT);
			$packet .= str_pad(dechex($object->layer), 2, "0", STR_PAD_LEFT);
			$packet .= str_pad(dechex($object->color), 4, "0", STR_PAD_LEFT);
			$packet .= "20";
			$packet .= "0000";

			$updateRange = array(
				'from' => array('x' => ($object->pos_x - 10), 'y' => ($object->pos_y - 10)),
				'to' => array('x' => ($object->pos_x + 10), 'y' => ($object->pos_y + 10))
			);

			foreach ($chunk['players'] as $client => $alive) {
				$player = UltimaPHP::$socketClients[$client]['account']->player;
				if ($player->position['x'] >= $updateRange['from']['x'] && $player->position['x'] <= $updateRange['to']['x'] && $player->position['y'] >= $updateRange['from']['y'] && $player->position['y'] <= $updateRange['to']['y']) {
					Sockets::out($player->client, $packet, false);
				}
			}
		}
	}
}