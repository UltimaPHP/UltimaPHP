<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Cache {
		public $fileHash;
		public $fileContents;

		public static function getFileHash($filePath) {
				return md5_file($filePath);
		}

		public static function readFile($filePath) {
				$filePath = self::replaceExtension($filePath);

				if (is_file($filePath)) {
						$json = file_get_contents($filePath);

						$cache = json_decode($json);
						return $cache;
				}

				return new Cache();
		}

		public static function writeFile($filePath, $contents) {
				$fileHash = Cache::getFileHash($filePath);
				$filePath = self::replaceExtension($filePath);

				$cache = new Cache();
				$cache->fileHash = $fileHash;
				$cache->fileContents = $contents;

				file_put_contents($filePath, json_encode($cache));
		}

		public static function exists($filePath) {
				$fileHash = getFileHash($filePath);
				$filePath = self::replaceExtension($filePath);

				$cacheHash = Cache::readFile($filePath);

				return $fileHash == $cacheHash->fileHash;
		}

		private static function replaceExtension($filePath) {
				$info = pathinfo($filePath);
    		return $info['dirname'] . '/' . $info['filename'] . '.cache';
		}
}