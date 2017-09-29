<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class TestGump extends Gumps {
    public function build() {
        $this->addBackground(100, 100, 400, 400, 9200);
        $this->addText(110, 110, 1935, "Test Label");
        $this->addGumpPic(307, 89, 5010, 1935);
        $this->addGumpPicTiled(139, 299, 320, 19, 30089);
        $this->addTransparency(118, 139, 186, 146);
        $this->addCheckbox(149, 340, 211, 210, 0, 0);
        $this->addGroup(55);
        $this->addRadio(149, 369, 208, 209, 0, 0);
        $this->addTilePicHue(200, 344, 2491, 1935);
        $this->addTextEntry(279, 354, 200, 20, 1935, 99, "default text");
        $this->addButtom(298, 391, 247, 248, 1, 0, 1);
        $this->addButtom(371, 390, 247, 248, 1, 2, 0);
        $this->addHtmlGump(169, 435, 273, 41, "HTML TEXT ENTRY", 1, 1);
    }
}