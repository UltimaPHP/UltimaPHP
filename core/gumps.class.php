<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Gumps {
    public $id;
    private $client;
    private $pages = [];

    /**
     * Dialog basic methods
     */
    public function __construct($client = false) {
        if (!$client) {
            return false;
        }

        $this->client = $client;
    }

    /**
     * Send the compressed packet 0xDD to the client
     */
    public function show() {

    }

    /**
     * Send the close dialog packet to the client
     */
    public function close() {

    }

    /**
     * Updates dialog view to the player
     */
    public function update() {

    }

    /**
     * Build the layout information format and then compress in huffman table
     */
    private function compressLayout() {

    }

    /**
     * Build the text information format and then compress in huffman table
     */
    private function compressTexts() {

    }

    /**
     * Dialog building methods
     */

    /* {resizepic 38 125 9200 445 298} */
    public function addResizePic($x = 0, $y = 0, $gump = null, $to_x = 1, $to_y = 1, $page = 0) {
        if (!isset($this->pages[$page])) {
            $this->pages[$page] = [];
        }

        if ($gump === null) {
            return false;
        }

        $this->pages[$page][] = [
            'type' => GumpDefs::TYPE_RESIZEPIC,
            'x'    => $x,
            'y'    => $y,
            'gump' => $gump,
            'to_x' => $to_x,
            'to_y' => $to_y,
        ];

        return true;
    }

    /* {gumppictiled 50 155 170 230 2624} */
    public function addGumpPicTiled($x = 0, $y = 0, $gump = null, $to_x = 1, $to_y = 1, $page = 0) {
        if (!isset($this->pages[$page])) {
            $this->pages[$page] = [];
        }

        if ($gump === null) {
            return false;
        }

        $this->pages[$page][] = [
            'type' => GumpDefs::TYPE_GUMPPICTILED,
            'x'    => $x,
            'y'    => $y,
            'gump' => $gump,
            'to_x' => $to_x,
            'to_y' => $to_y,
        ];

        return true;
    }

    /* {checkertrans 50 155 170 230} */
    public function addCheckerTrans($x = 0, $y = 0, $to_x = 1, $to_y = 1, $page = 0) {
        if (!isset($this->pages[$page])) {
            $this->pages[$page] = [];
        }

        $this->pages[$page][] = [
            'type' => GumpDefs::TYPE_CHECKERTRANS,
            'x'    => $x,
            'y'    => $y,
            'to_x' => $to_x,
            'to_y' => $to_y,
        ];

        return true;
    }

    /* {gumppic 451 74 10441} */
    public function addGumpPic($x = 0, $y = 0, $gump = null, $page = 0) {
        if (!isset($this->pages[$page])) {
            $this->pages[$page] = [];
        }

        if ($gump === null) {
            return false;
        }

        $this->pages[$page][] = [
            'type' => GumpDefs::TYPE_GUMPPIC,
            'x'    => $x,
            'y'    => $y,
            'gump' => $gump,
        ];

        return true;
    }

    /* {htmlgump 52 130 408 20 0 0 0} */
    public function addHtmlGump($x = 0, $y = 0, $unknow1 = 0, $unknow2 = 0, $unknow3 = 0, $unknow4 = 0, $unknow5 = 0, $text = null, $page = 0) {
        if (!isset($this->pages[$page])) {
            $this->pages[$page] = [];
        }

        if ($text === null) {
            return false;
        }

        $this->pages[$page][] = [
            'type'    => GumpDefs::TYPE_HTMLGUMP,
            'x'       => $x,
            'y'       => $y,
            'unknow1' => $unknow1,
            'unknow2' => $unknow2,
            'unknow3' => $unknow3,
            'unknow4' => $unknow4,
            'unknow5' => $unknow5,
            'text'    => $text,
        ];

        return true;
    }

    /* {text 90 173 1152 1} */
    public function addText($x = 0, $y = 0, $color = 0, $id = null, $text = null, $page = 0) {
        if (!isset($this->pages[$page])) {
            $this->pages[$page] = [];
        }

        if ($color < 0 || $text === null) {
            return false;
        }

        $this->pages[$page][] = [
            'type'  => GumpDefs::TYPE_TEXT,
            'x'     => $x,
            'y'     => $y,
            'color' => $color,
            'id'    => $id,
            'text'  => $text,
        ];

        return true;
    }

    /* {button 70 176 2117 2118 0 1 0} */
    public function addButton($x = 0, $y = 0, $gump = null, $gumpPressed = null, $unknow1 = 0, $unknow2 = 0, $unknow3 = 0, $page = 0) {
        if (!isset($this->pages[$page])) {
            $this->pages[$page] = [];
        }

        if ($gump === null || $gumpPressed === null) {
            return false;
        }

        $this->pages[$page][] = [
            'type'        => GumpDefs::TYPE_BUTTON,
            'x'           => $x,
            'y'           => $y,
            'gump'        => $gump,
            'gumpPressed' => $gumpPressed,
            'unknow1'     => $unknow1,
            'unknow2'     => $unknow2,
            'unknow3'     => $unknow3,
        ];

        return true;
    }

    /* {page 1} */
    public function addPage($number = 1) {
        if ($number < 1) {
            return false;
        }
        if (!isset($this->pages[$number])) {
            $this->pages[$number] = [];
        }

        return true;
    }
}