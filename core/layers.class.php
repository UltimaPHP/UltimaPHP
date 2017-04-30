<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Layer {
    public static $id;
    public static $player;
    public static $itenSerial;
    public static $serial;

    public function __construct($type = null, $player = null, $itemSerial = null) {
    	if ($type === null || $player === null || $itemSerial === null) {
    		return false;
    	}

    	/* Check if player exists */
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public static function getId() {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public static function setId($id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of player.
     *
     * @return mixed
     */
    public static function getPlayer() {
        return $this->player;
    }

    /**
     * Sets the value of player.
     *
     * @param mixed $player the player
     *
     * @return self
     */
    public static function setPlayer($player) {
        $this->player = $player;

        return $this;
    }

    /**
     * Gets the value of itenSerial.
     *
     * @return mixed
     */
    public static function getItenSerial() {
        return $this->itenSerial;
    }

    /**
     * Sets the value of itenSerial.
     *
     * @param mixed $itenSerial the iten serial
     *
     * @return self
     */
    public static function setItenSerial($itenSerial) {
        $this->itenSerial = $itenSerial;

        return $this;
    }

    /**
     * Gets the value of serial.
     *
     * @return mixed
     */
    public static function getSerial() {
        return $this->serial;
    }

    /**
     * Sets the value of serial.
     *
     * @param mixed $serial the serial
     *
     * @return self
     */
    public static function setSerial($serial) {
        $this->serial = $serial;

        return $this;
    }
}