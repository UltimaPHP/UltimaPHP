<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Cache {
    public $fileHash;
    public $fileContents;

    public static function exists($filePath) {
			if (is_file($filePath)) {
					$fileHash = self::getFileHash($filePath);
					$fileCachePath = self::replaceExtension($filePath);					
					$cache = self::readFile($fileCachePath);

					if (!is_null($cache) && $cache->fileHash == $fileHash) {
							return $cache;
					}
			}
			return NULL;
	}

    public static function getFileHash($filePath) {
			if (is_file($filePath)) {
				return md5_file($filePath);
			}
			return NULL;
    }

    public static function readFile($filePath) {
        $filePath = self::replaceExtension($filePath);

        if (is_file($filePath)) {
            $json = file_get_contents($filePath);
            $cache = unserialize(base64_decode($json));
            return $cache;
        }
        return NULL;
    }

    public static function writeFile($filePath, $contents) {
				$fileHash = self::getFileHash($filePath);
				
				if (!is_null($fileHash)) {
					$fileCachePath = self::replaceExtension($filePath);

					$cache = new Cache();
					$cache->fileHash = $fileHash;
					$cache->fileContents = $contents;
					$json = base64_encode(serialize($cache));
					file_put_contents($fileCachePath, $json);
				}
    }

    private static function replaceExtension($filePath) {
        $info = pathinfo($filePath);
        return $info['dirname'] . '/' . $info['filename'] . '.cache';
    }
}
