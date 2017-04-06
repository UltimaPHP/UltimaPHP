<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class SkillBlacksmith {
    public $id    = 7;
    public $name  = "blacksmith";
    public $title = "Blacksmith";
    public $flags = SkillsDefs::SKILL_FLAG_SELECTABLE;
    public $value = 0;

    public function __construct($value = 0) {
        $this->value = $value;
    }
}