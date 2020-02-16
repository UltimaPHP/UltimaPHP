<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

class OpenStoreGump extends Gumps {
    public function build() {
        $player = UltimaPHP::$socketClients[$this->getClient()]['account']->player;

        $this->addPage(0);
        $this->addGumpPic(0,0,40009);

        $this->addECHandleInput();
        
        // Category == StoreCategory.Featured ? 40031 : 40021
        $this->addButton(36,97,40021,40031, 100, 1, 0);
        $this->addXmfHtmlTok(76,100,125,25,1114513, 1156587, 32767, 0, 0);

        $this->addECHandleInput();
        $this->addECHandleInput();

        // Category == StoreCategory.Character ? 40031 : 40021
        $this->addButton(36,126, 40021,40031, 101, 1, 0);
        $this->addXmfHtmlTok(72,129,125,25,1114513, 1156588, 32767, 0, 0);

        $this->addECHandleInput();
        $this->addECHandleInput();

        // Category == StoreCategory.Equipment ? 40031 : 40021
        $this->addButton(36,155, 40021,40031, 102, 1, 0);
        $this->addXmfHtmlTok(73,158,125,25,1114513, 1078237, 32767, 0, 0);

        $this->addECHandleInput();
        $this->addECHandleInput();

        // Category == StoreCategory.Decorations ? 40031 : 40021
        $this->addButton(36,184, 40021,40031, 103, 1, 0);
        $this->addXmfHtmlTok(67,187,125,25,1114513, 1044501, 32767, 0, 0);

        $this->addECHandleInput();
        $this->addECHandleInput();

        // Category == StoreCategory.Mounts ? 40031 : 40021
        $this->addButton(36,213, 40021,40031, 104, 1, 0);
        $this->addXmfHtmlTok(80, 216,125,25,1114513, 1154981, 32767, 0, 0);

        $this->addECHandleInput();
        $this->addECHandleInput();

        // Category == StoreCategory.Misc ? 40031 : 40021
        $this->addButton(36,242, 40021,40031, 105, 1, 0);
        $this->addXmfHtmlTok(63,245,125,25,1114513, 1011173, 32767, 0, 0);

        $this->addECHandleInput();
        $this->addECHandleInput();

        // Promotional Code
        $this->addButton(36,271, 40021,40031, 106, 1, 0);
        $this->addXmfHtmlTok(50,274,125,25,1114513, 1156589, 32767, 0, 0);

        $this->addECHandleInput();
        $this->addECHandleInput();

        // FAQ
        $this->addButton(36,300, 40021,40031, 107, 1, 0);
        $this->addXmfHtmlTok(87,303,125,25,1114513, 1156875, 32767, 0, 0);

        $this->addECHandleInput();

        $this->addGumpPic(36, 331, 40010);

        //Sort by:
        $this->addXmfHtmlTok(72, 334, 125, 25, 1114513, 1044580, 10565, 0, 0);

        $this->addButton(43, 360, 40014, 40015, 108, GumpButtonType::Reply, 0);
        $this->addXmfHtmlGumpColor(68, 360, 88, 25, 1037013, 27477, 0, 0); // Name

        $this->addButton(43, 386, 40014, 40015, 109, GumpButtonType::Reply, 0);
        $this->addXmfHtmlGumpColor(68, 386, 88, 25, 1062218, 27477, 0, 0); // Price Down
        $this->addGumpPic(110, 386, 40032);

        $this->addButton(43, 412, 40014, 40015, 110, GumpButtonType::Reply, 0);
        $this->addXmfHtmlGumpColor(68, 412, 88, 25, 1062218, 27477, 0, 0); // Price Up
        $this->addGumpPic(110, 412, 40033);

        $this->addButton(43, 438, 40014, 40015, 111, GumpButtonType::Reply, 0);
        $this->addXmfHtmlGumpColor(68, 438, 88, 25, 1156590, 27477, 0, 0); // Newest

        $this->addButton(43, 464, 40014, 40015, 112, GumpButtonType::Reply, 0);
        $this->addXmfHtmlGumpColor(68, 464, 88, 25, 1156591, 27477, 0, 0); // Oldest

        $this->addECHandleInput();

        $this->addButton(598, 36, 40020, 40030, 113, GumpButtonType::Reply, 0);
        $this->addXmfHtmlTok(628, 39, 123, 25, "CarCount", 1156593, 32767, 0, 0); //Car

        $this->addECHandleInput();

        $this->addBackground(167, 516, 114, 22, 0x2486);
        $this->addTextEntry(169, 518, 110, 18, 0, 16, "", 169);

        $this->addECHandleInput();

        $this->addButton(286, 516, 40018, 40028, 114, GumpButtonType::Reply, 0);
        $this->addXmfHtmlTok(300, 519, 64, 22, 1114513, 1154641, 32767, 0, 0); // Search

        $this->addECHandleInput();

        $this->addGumpPic(36, 74, 40022);
        $this->addLabelCropped(59, 74, 100, 14, 455, "GetCurrency not implemented");

        $this->addECHandleInput();

    }

    public static function callback($client, $buttonId)
	{
        
        switch($buttonId)
		{									
            case 1:
                new SysmessageCommand($client, ["Go To Help Room"]);
                break;
            case 2:
                new SysmessageCommand($client, ["Send Page"]);
                break;
            case 3:
                new SysmessageCommand($client, ["Staffers"]);
                break;
            case 4:
                new SysmessageCommand($client, ["Site"]);
				break;
			case 5:
                new SysmessageCommand($client, ["Forum"]);
                break;              
		}
    }
}