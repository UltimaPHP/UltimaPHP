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
        
        $testeLayout = "{resizepic 38 125 9200 445 298}{gumppictiled 50 155 170 230 2624}{gumppictiled 240 155 232 230 2624}{checkertrans 50 155 170 230}{gumppic 451 74 10441}{htmlgump 52 130 408 20 0 0 0}{text 90 173 1152 1}{text 90 203 1152 2}{text 90 233 1152 3}{text 90 263 1152 4}{text 90 323 1152 5}{text 90 353 1152 6}{button 70 176 2117 2118 0 1 0}{button 70 206 2117 2118 0 2 0}{button 70 236 2117 2118 0 3 0}{button 70 266 2117 2118 0 4 0}{button 70 326 2117 2118 1 0 1}{button 70 356 2117 2118 1 0 2}{checkertrans 240 155 232 230}{text 90 293 1152 7}{button 70 296 2117 2118 1 0 3}{page 1}{htmlgump 244 158 226 224 8 8 0}{button 409 388 247 248 1 0 4}{page 2}{htmlgump 244 158 226 224 9 9 0}{button 409 388 247 248 1 0 5}{page 3}{text 250 173 132 10}{text 250 198 132 11}{text 250 223 132 12}{text 250 248 132 13}{text 250 273 132 14}{text 250 298 132 15}{text 250 323 132 16}{text 250 348 132 17}{text 50 393 67 18}{page 4}{htmlgump 243 158 228 225 19 19 0}";
        $testeTexto = "&<center>Dragon Shard - T2A - Help MenuIr Para Help Room
                                                                       Enviar Page
  Seus StatusStatus do ShardSiteForuStaffers<center>Ir para a Help Room. Caso deseje ir para a Help Room clique em Okay. e em 2 minutos vc sera teleportado, Caso esteja morto em 10 segundos voce sera teleportado e ressado. Se der o tempo e vc estiver em War mode, Poisoned, Stoned vc nao sera teleportado.}<center>Enviar Page - A staff nao permite Flood de Pages. vc pode mandar 1 page a cada 5 minutos. Clique em Okay para enviar.Nick: Destiny - ID: 12900166Str: 100 Hits: 100Int: 100 Mana: 100Dex: 100 Stam: 10Kills: 0
Deaths: 14
Fame: 2721
          Karma: 10000#Sua conta sera VIP por mais 1 Dias.�<center>Status do Dragon Shard - T2A.<br>Sphere Version 0.56d-Nightly [Linux] by www.spherecommunity.net.<br>Tempo On: 268.<br>Chars: 5246.<br>Items: 512057.<br>Players On: 1.";
        
        $teste = new packet_0xDD($this->getX(), $this->getY(), $testeLayout, $testeTexto, $this->client);
        $teste->send();
    }
    
    
}

