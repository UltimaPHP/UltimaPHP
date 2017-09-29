<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Gumps {
    public $id;
    private $client;
    private $pages = [];
    private $text  = [];

    private $x, $y, $noMove, $noClose, $noDispose, $type;
    public $layout, $textLayout, $gumpId;

    /**
     * Dialog basic methods
     */
    public function __construct($client = false) {
        if (!$client) {
            return false;
        }

        $this->setType(1);
        $this->setNoClose(false);
        $this->setNoDispoe(false);
        $this->setNoMove(false);
        $this->setX(50);
        $this->setY(50);
        $this->client = $client;

        if ($this->getGumpId() === null) {
            $id = $this->retriveNewGumpId();
            $this->setGumpId($id);

            Map::$gumpsIds[$id] = &$this;
        }
    }

    private function retriveNewGumpId() {
        $tmpId = rand(1000000000, 4294967295);

        if (isset(Map::$gumpsIds[$tmpId])) {
            $tmpId = $this->retriveNewGumpId();
        }

        return $tmpId;
    }

    public function setGumpId($gumpId) {
        $this->gumpId = $gumpId;
    }

    public function getGumpId() {
        return $this->gumpId;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function getX() {
        return $this->x;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function getY() {
        return $this->y;
    }

    public function setNoClose($noClose) {
        $this->noClose = $noClose;
    }

    public function getNoClose() {
        return $this->noClose;
    }

    public function setNoMove($noMove) {
        $this->noMove = $noMove;
    }

    public function getNoMove() {
        return $this->noMove;
    }

    public function setNoDispoe($noDispose) {
        $this->noDispose = $noDispose;
    }

    public function getNoDispose() {
        return $this->noDispose;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function getText() {
        return $this->text;
    }

    public function getTextParsed() {
        $textStr = "";

        foreach ($this->getText() as $id => $text) {
            $length = str_pad(dechex(strlen($text)), 4, "0", STR_PAD_LEFT);
            $text   = Functions::strToHex($text, true);

            $textStr .= $length . $text;
        }

        return $textStr;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    /**
     * Send the compressed packet 0xDD to the client
     */
    public function show() {
        $this->build();
        $packet = new packet_0xDD($this->client, $this);
        $packet->send();
    }

    /**
     * Dialog building methods
     */
    public function addBackground($x, $y, $size_x, $size_y, $gump) {
        $this->layout .= "{resizepic $x $y $gump $size_x $size_y}";
    }

    public function addText($x, $y, $color, $text) {
        $this->text[] = $text;
        $textId       = count($this->text) - 1;

        $this->layout .= "{text $x $y $color $textId}";
    }

    public function addGumpPic($x, $y, $gump, $color) {
        $this->layout .= "{gumppic $x $y $gump hue=$color}";
    }

    public function addGumpPicTiled($x, $y, $to_x, $to_y, $gump) {
        $this->layout .= "{gumppictiled $x $y $to_x $to_y $gump}";
    }

    public function addTransparency($x, $y, $to_x, $to_y) {
        $this->layout .= "{checkertrans $x $y $to_x $to_y}";
    }

    public function addCheckbox($x, $y, $gump, $gump_pressed, $info_1, $info_2) {
        $this->layout .= "{checkbox $x $y $gump $gump_pressed $info_1 $info_2}";
    }

    public function addGroup($group_id) {
        $this->layout .= "{Group $group_id}";
    }

    public function addRadio($x, $y, $gump, $gump_pressed, $info_1, $info_2) {
        $this->layout .= "{radio $x $y $gump $gump_pressed $info_1 $info_2}";
    }

    public function addTilePicHue($x, $y, $item_id, $color) {
        $this->layout .= "{tilepichue $x $y $item_id $color}";
    }

    public function addTextEntry($x, $y, $to_x, $to_y, $color, $id, $text) {
        $this->text[] = $text;
        $textId       = count($this->text) - 1;

        $this->layout .= "{textentry $x $y $to_x $to_y $color $id $textId}";
    }

    public function addButtom($x, $y, $gump, $gump_pressed, $info_1, $info_2, $info_3) {
        $this->layout .= "{button $x $y $gump $gump_pressed $info_1 $info_2 $info_3}";
    }

    public function addHtmlGump($x, $y, $info_1, $info_2, $text, $info_4, $info_5) {
        $this->text[] = $text;
        $textId       = count($this->text) - 1;

        $this->layout .= "{htmlgump $x $y $info_1 $info_2 $textId $info_4 $info_5}";
    }
}