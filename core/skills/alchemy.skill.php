<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class SkillAlchemy {
    public $id    = 0;
    public $name  = "alchemy";
    public $title = "alchemist";
    public $flags = SkillsDefs::SKILL_FLAG_MAGIC | SkillsDefs::SKILL_FLAG_CRAFT;
    public $value = 0;

    public function __construct($value = 0) {
        $this->value = $value;
    }
}