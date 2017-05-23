<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class TargetCommand extends Command {

    public function __construct($client, $args = []) {

        if ($client === null) {
            return false;
        }        
        
        Player::attachTarget($client);
				
        return true;
    }
}   