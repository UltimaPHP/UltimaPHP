<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TypeContainer extends UObject {
    public $gump;
    /* access properties */
    public $owner;

    /* carry properties */
    public $maxCarryCapacity;
    public $actualCarry;
    /* Weight properties */
    public $maxWeightCapacity;
    public $actualWeight;
    /* Inside UObjects */
    public $UObjects = [];

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

        return $this->message($this->name . " (" . count($this->UObjects) . " item " . (count($this->UObjects) > 1 ? "s" : "") . ")", 0, 3, $client);
    }

    public function dclick($client = null) {
        return $this->open($client);
    }

    public function addItem(UObject $UObject, $client = false, $position = false, $noUpdate = false) {
        if (!$UObject || !$client) {
            return false;
        }

        if (!$position) {
            $position = [
                'x' => rand(1, 127),
                'y' => rand(1, 127),
            ];
        }

        $UObject->position['x']   = $position['x'];
        $UObject->position['y']   = $position['y'];
        $UObject->position['z']   = null;
        $UObject->position['map'] = null;
        $UObject->holder          = $this->serial;
        $UObject->save();

        $this->UObjects[] = $UObject->serial;
        $this->save();

        if (Map::isValidSerial($UObject->serial)) {
            Map::updateObjectHolder($UObject);
        } else {
            Map::addHoldedObject($UObject);
        }

        if (Map::isValidSerial($this->serial)) {
            Map::updateObjectHolder($this);
        } else {
            Map::addHoldedObject($this);
        }

        if (!$noUpdate) {
            $this->addItemToOpenedContainer($UObject, $client);
            // $this->renderItems($client);
        }

        return true;
    }

    public function removeItem($client = false, $UObjectSerial = false) {
        if (!$UObjectSerial || !$client) {
            return false;
        }

        if (($key = array_search($UObjectSerial, $this->UObjects)) !== false) {
            unset($this->UObjects[$key]);
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

        if (count($this->UObjects) > 0) {
            $this->renderItems($client);
        }

        return true;
    }

    public function addItemToOpenedContainer(UObject $instance, $client = false) {
        $packet = new packet_0x25($instance, $client);
        $packet->send();
    }

    public function renderItems($client) {
        $tmpPacket = str_pad(dechex(count($this->UObjects)), 4, "0", STR_PAD_LEFT);
        foreach ($this->UObjects as $key => $serial) {
            $instance = Map::getBySerial($serial);

            $tmpPacket .= str_pad($instance->serial, 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($instance->graphic), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= "00";
            $tmpPacket .= str_pad(dechex($instance->amount), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($instance->position['x']), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($instance->position['y']), 4, "0", STR_PAD_LEFT);
            $tmpPacket .= "00";
            $tmpPacket .= str_pad($this->serial, 8, "0", STR_PAD_LEFT);
            $tmpPacket .= str_pad(dechex($instance->color), 4, "0", STR_PAD_LEFT);
        }

        $packet = "3C";
        $packet .= str_pad(dechex(ceil(strlen($tmpPacket) / 2) + 3), 4, "0", STR_PAD_LEFT);
        $packet .= $tmpPacket;

        Sockets::out($client, $packet);
        return true;
    }
}