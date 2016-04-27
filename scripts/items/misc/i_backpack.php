<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class i_backpack extends Object {

    public function build() {
        $this->name = "Backpack%s";
        $this->graphic = 0x0e75;
        $this->type = "type_container";
        $this->flags = 0x0;
        $this->value = 100;
        $this->amount = 1;
        $this->color = 0x0;
    }

}
