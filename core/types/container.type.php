<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TypeContainer extends Object {
    public $gump;
    /* access properties */
    public $owner;

    /* carry properties */
    public $maxCarryCapacity;
    public $actualCarry;
    /* Weight properties */
    public $maxWeightCapacity;
    public $actualWeight;
    /* Inside objects */
    public $objects = [];

    public function typeStart() {
        $this->actualCarry  = 0;
        $this->actualWeight = 0;
        $this->equiped      = false;
        $this->owner        = null;
    }

    public function click($client = null) {
        if ($client === null) {
            return false;
        }
        
        return $this->message($this->name . " (".count($this->objects)." item ". (count($this->objects) > 1 ? "s" : "") .")", 0, 3, $client);
    }

    public function dclick($client = null) {
        return $this->open($client);
    }

    public function addItem($client = false, Object $object, $position = false, $noUpdate = false) {
        if (!$object || !$client) {
            return false;
        }

        if (!$position) {
            $position = [
                'x' => rand(1,127),
                'y' => rand(1,127)
            ];
        }

        $object->position['x'] = $position['x'];
        $object->position['y'] = $position['y'];
        $object->position['z'] = null;
        $object->position['map'] = null;
        $object->holder = $this->serial;
        $object->save();

        $this->objects[] = $object->serial;
        $this->save();

        if (Map::isValidSerial($object->serial)) {
            Map::updateObjectHolder($object);
        } else {
            Map::addHoldedObject($object);
        }

        if (Map::isValidSerial($this->serial)) {
            Map::updateObjectHolder($this);
        } else {
            Map::addHoldedObject($this);
        }

        if (!$noUpdate) {
            $this->addItemToOpenedContainer($client, $object);
            // $this->renderItems($client);
        }

        return true;
    }

    public function removeItem($client = false, $objectSerial = false) {
        if (!$objectSerial || !$client) {
            return false;
        }

        if(($key = array_search($objectSerial, $this->objects)) !== false) {
            unset($this->objects[$key]);
            $this->save();
        }

        Map::updateObjectHolder($this);
        return true;
    }

    public function open($client) {
        return $this->drawContainer($client);
    }

    public function drawContainer($client) {
        $packet = "24";
        $packet .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
        $packet .= str_pad(dechex($this->gump), 4, "0", STR_PAD_LEFT);
        $packet .= "007F";
        Sockets::out($client, $packet);

        if (count($this->objects) > 0) {
            $this->renderItems($client);
        }

        return true;
    }

    public function addItemToOpenedContainer($client = false, Object $instance) {
        $packet = new packet_0x25($client, $instance);
        $packet->send();
    }

    public function renderItems($client) {
        $tmpPacket = str_pad(dechex(count($this->objects)), 4, "0", STR_PAD_LEFT);
        foreach ($this->objects as $key => $serial) {
            $instance = Map::getBySerial($serial);

            $tmpPacket .= str_pad($instance->serial, 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($instance->graphic), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= "00";
            $tmpPacket .= str_pad(dechex($instance->amount), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($instance->position['x']), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($instance->position['y']), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= "00";
            $tmpPacket .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($this->color), 4, "0", STR_PAD_LEFT);
        }

        $packet = "3C";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 3), 4, "0", STR_PAD_LEFT);
        $packet .= $tmpPacket;

        Sockets::out($client, $packet);
        return true;
    }
}