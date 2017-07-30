<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 *
 * Send the server list to the client
 */
class packet_0x25 extends Packets {

    private $serial;
    private $graphic;
    private $offset;
    private $amount;
    private $pos_x;
    private $pos_y;
    private $slot;
    private $container;
    private $color;

    /**
     * Defines the packet, the length and if there is a client send
     */
    public function __construct($client = false, Object $instance) {
        $this->setPacket(0x25);

        if ($client) {
            $this->client = $client;
        }

        if ($instance) {
            $this->setSerial($instance->serial);
            $this->setGraphic($instance->graphic);
            $this->setOffset(0);
            $this->setAmount($instance->amount);
            $this->setPosX($instance->position['x']);
            $this->setPosY($instance->position['y']);
            $this->setSlot(0);
            $this->setContainer($instance->holder);
            $this->setColor($instance->color);
        }
    }

    /**s
     * Handle the packet transmission
     */
    public function send() {
        if (!$this->client) {
            return false;
        }
        
        $this->addHexStr($this->getSerial());
        $this->addInt16($this->getGraphic());
        $this->addInt8($this->getOffset());
        $this->addInt16($this->getAmount());
        $this->addInt16($this->getPosX());
        $this->addInt16($this->getPosY());
        $this->addInt8($this->getSlot());
        $this->addHexStr($this->getContainer());
        $this->addInt16($this->getColor());

        return Sockets::out($this->client, $this);
    }

    public function getSerial() {
        return $this->serial;
    }

    public function setSerial($serial) {
        $this->serial = $serial;
    }

    public function getGraphic() {
        return $this->graphic;
    }

    public function setGraphic($graphic) {
        $this->graphic = $graphic;
    }

    public function getOffset() {
        return $this->offset;
    }

    public function setOffset($offset) {
        $this->offset = $offset;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getPosX() {
        return $this->pos_x;
    }

    public function setPosX($pos_x) {
        $this->pos_x = $pos_x;
    }

    public function getPosY() {
        return $this->pos_y;
    }

    public function setPosY($pos_y) {
        $this->pos_y = $pos_y;
    }

    public function getSlot() {
        return $this->slot;
    }

    public function setSlot($slot) {
        $this->slot = $slot;
    }

    public function getContainer() {
        return $this->container;
    }

    public function setContainer($container) {
        $this->container = $container;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }
}