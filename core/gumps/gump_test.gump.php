<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class gump_test extends Gumps
{
    public function __construct($client = false) {
        parent::__construct($client);
              
        $this->client = $client;
    }
    
    public function show()
    {        
        $this->addPage();        
        $this->addResizeGump( 0, 40, 0xA28, 450, 420 ); //Background
	$this->addGump( 105, 18, 0x58B ); // Fancy top-bar
	$this->addGump( 182, 0, 0x589 ); // "Button" like gump
	$this->addTilePic( 202, 23, 0x14eb ); // Type of info menu
	$this->addText( 170, 90, "Spawnregion Info" , 0x530 );
	// Give information about the spawnregion
	$this->addText( 50, 120, "Name: %1" , 0x834 );
	$this->addText( 50, 140, "NPCs: %1 of %2", 0x834 );
        $this->addText( 50, 160, "Items: %1 of %2", 0x834 );
        
        $teste = new packet_0xDD($this->getX(), $this->getY(), $this->layout, "", $this->client);
        $teste->send();
    }
    
    
}

