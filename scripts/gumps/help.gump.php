<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class HelpMenuGump extends Gumps {
    public function build() {
    	$player = UltimaPHP::$socketClients[$this->getClient()]['account']->player;

        $this->addBackground(38, 125, 445, 298, 9200);
        $this->addGumpPicTiled(50, 155, 170, 230, 2624);
        $this->addGumpPicTiled(240, 155, 232, 230, 2624);
        $this->addTransparency(50, 155, 170, 230);
        $this->addGumpPic(451, 74, 10441);
        $this->addHtmlGump(52, 130, 408, 20, 0, 0, UltimaPHP::$conf['server']['name']);
        $this->addText(90, 173, 1152, "Go to the help room");
        $this->addText(90, 203, 1152, "Send page");
        $this->addText(90, 233, 1152, "Your Stats");
        $this->addText(90, 263, 1152, "Shard Stats");
        $this->addText(90, 323, 1152, "Site");
        $this->addText(90, 353, 1152, "Forum");
        $this->addButton(70, 176, 2117, 2118, 0, 1, 0);
        $this->addButton(70, 206, 2117, 2118, 0, 2, 0);
        $this->addButton(70, 236, 2117, 2118, 0, 3, 0);
        $this->addButton(70, 266, 2117, 2118, 0, 4, 0);
        $this->addButton(70, 326, 2117, 2118, 1, 0, 1);
        $this->addButton(70, 356, 2117, 2118, 1, 0, 2);
        $this->addTransparency(240, 155, 232, 230);
        $this->addText(90, 293, 1152, "Staffers");
        $this->addButton(70, 296, 2117, 2118, 1, 0, 3);

        $this->addPage(1);
        $this->addHtmlGump(244, 158, 226, 224, 8, 0, "Go to the help room.<br><br>If you want to go to the Help Room click on the button bellow and in 2 minutes you will be teleported, if you're dead you will be teleported in 10 seconds and then resurrected. Any attempt of combat, spell casting will stop the teleport.");
        $this->addButton(409, 388, 247, 248, 1, 0, 4);
        
        $this->addPage(2);
        $this->addHtmlGump(244, 158, 226, 224, 9, 0, "Send page.<br><br>You must wait 30 minutes to send another page again, use carefully.<br><br>Click in the button bellow to send a new page.");
        $this->addButton(409, 388, 247, 248, 1, 0, 5);
        
        $this->addPage(3);
        $this->addText(250, 173, 132, "Name: {$player->name} - ID: {$player->serial}");
        $this->addText(250, 198, 132, "Str: {$player->str} Hits: {$player->hits}");
        $this->addText(250, 223, 132, "Int: {$player->int} Mana: {$player->mana}");
        $this->addText(250, 248, 132, "Dex: {$player->dex} Stam: {$player->stam}");
        $this->addText(250, 273, 132, "Kills: {$player->kills}");
        $this->addText(250, 298, 132, "Deaths: {$player->deaths}");
        $this->addText(250, 323, 132, "Fame: {$player->fame}");
        $this->addText(250, 348, 132, "Karma: {$player->karma}");
        
        $this->addPage(4);
        $this->addHtmlGump(243, 158, 228, 225, 19, 0, "Status server info.");
    }
}