<?php 
 /**
* Ultima PHP - OpenSource Ultima Online Server written in PHP
* Version: 0.1 - Pre Alpha
*/
 class GoMenuGump extends Gumps {
	public function build() {
		$player = UltimaPHP::$socketClients[$this->getClient()]['account']->player;

		$this->setNoClose(False);
		$this->setNoDispose(False);
		$this->setNoMove(False);

		$this->addPage(0);
		$this->addBackground(113, 57, 642, 505, 302);
		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");


		$this->addPage(1);
		$this->addButton(144, 153, 5603, 5607, 0, 0, 6);
		$this->addButton(277, 153, 5601, 5605, 0, 1, 2);
		$this->addText(199, 152, 0, "Felucca");

		$this->addGumpPic(335, 137, 5593, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addText(185, 208, 0, "Towns");

		$this->addText(187, 243, 0, "Dungeons");

		$this->addButton(156, 211, 11410, 11412, 0, 7, 7);
		$this->addButton(156, 246, 11410, 11412, 0, 8, 8);

		$this->addPage(2);
		$this->addGumpPic(335, 137, 5594, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(278, 153, 5601, 5605, 0, 2, 3);
		$this->addText(199, 152, 0, "Trammel");

		$this->addButton(144, 153, 5603, 5607, 0, 4, 1);
		$this->addText(185, 208, 0, "Towns");

		$this->addText(187, 243, 0, "Dungeons");

		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");

		$this->addButton(156, 211, 11410, 11412, 1, 8, 12);
		$this->addButton(156, 246, 11410, 11412, 1, 9, 13);

		$this->addPage(3);
		$this->addGumpPic(335, 137, 5595, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 2, 2);
		$this->addButton(278, 153, 5601, 5605, 0, 3, 4);
		$this->addText(199, 152, 0, "Ilshenar");

		$this->addText(185, 208, 0, "Towns");

		$this->addText(187, 243, 0, "Dungeons");

		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");

		$this->addButton(156, 211, 11410, 11412, 1, 8, 14);
		$this->addButton(156, 246, 11410, 11412, 1, 9, 15);

		$this->addPage(4);
		$this->addGumpPic(335, 137, 5596, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 2, 3);
		$this->addButton(278, 153, 5601, 5605, 0, 3, 5);
		$this->addText(199, 152, 0, "Malas");

		$this->addText(185, 208, 0, "Towns");

		$this->addText(187, 243, 0, "Dungeons");

		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");

		$this->addButton(156, 211, 11410, 11412, 1, 8, 16);
		$this->addButton(156, 244, 11410, 11412, 1, 9, 17);

		$this->addPage(5);
		$this->addGumpPic(335, 137, 5597, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 2, 4);
		$this->addButton(279, 153, 5601, 5605, 0, 3, 6);
		$this->addText(199, 152, 0, "Tokuno");

		$this->addText(185, 208, 0, "Towns");

		$this->addText(187, 243, 0, "Dungeons");

		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");

		$this->addButton(156, 211, 11410, 11412, 1, 8, 18);
		$this->addButton(156, 246, 11410, 11412, 1, 9, 19);

		$this->addPage(6);
		$this->addButton(277, 153, 5601, 5605, 0, 0, 1);
		$this->addGumpPic(335, 137, 5598, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 3, 5);
		$this->addText(199, 152, 0, "TerMur");

		$this->addText(185, 208, 0, "Towns");

		$this->addText(187, 243, 0, "Dungeons");

		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");

		$this->addButton(156, 211, 11410, 11412, 1, 8, 20);
		$this->addButton(156, 246, 11410, 11412, 1, 9, 21);

		$this->addPage(7);
		$this->addText(184, 124, 0, "Britain");

		$this->addButton(156, 127, 11410, 11412, 1, 1, 100);
		$this->addText(183, 149, 0, "Buccaneers Den");

		$this->addButton(155, 151, 11410, 11412, 1, 3, 101);
		$this->addText(184, 172, 0, "Cove");

		$this->addButton(156, 176, 11410, 11412, 1, 5, 102);
		$this->addText(184, 198, 0, "Jhelom");

		$this->addButton(156, 202, 11410, 11412, 1, 7, 103);
		$this->addText(185, 222, 0, "Magincia");

		$this->addButton(156, 226, 11410, 11412, 1, 9, 104);
		$this->addText(184, 247, 0, "Minoc");

		$this->addButton(156, 251, 11410, 11412, 1, 11, 105);
		$this->addText(184, 272, 0, "Moonglow");

		$this->addButton(156, 275, 11410, 11412, 1, 13, 106);
		$this->addText(184, 298, 0, "Nujel'm");

		$this->addButton(156, 300, 11410, 11412, 1, 15, 107);
		$this->addButton(142, 90, 5603, 5607, 0, 16, 1);
		$this->addText(179, 89, 0, "Felucca - Towns");

		$this->addGumpPic(335, 137, 5593, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addText(184, 321, 0, "Ocllo");

		$this->addButton(156, 322, 11410, 11412, 1, 21, 108);
		$this->addText(184, 343, 0, "Serpents Hold");

		$this->addButton(156, 348, 11410, 11412, 1, 23, 109);
		$this->addText(184, 368, 0, "Skara Brae");

		$this->addButton(156, 372, 11410, 11412, 1, 25, 110);
		$this->addText(184, 391, 0, "Trinsic");

		$this->addButton(156, 394, 11410, 11412, 1, 27, 111);
		$this->addText(185, 417, 0, "Vesper");

		$this->addButton(157, 419, 11410, 11412, 1, 29, 112);
		$this->addText(185, 440, 0, "Wind");

		$this->addButton(157, 441, 11410, 11412, 1, 31, 113);
		$this->addText(185, 462, 0, "Yew");

		$this->addButton(157, 467, 11410, 11412, 1, 33, 114);
		$this->addText(185, 487, 0, "Delucia");

		$this->addButton(157, 491, 11410, 11412, 1, 35, 115);
		$this->addText(185, 514, 0, "Papua");

		$this->addButton(157, 517, 11410, 11412, 1, 37, 116);

		$this->addPage(8);
		$this->addText(184, 125, 0, "Covetous");

		$this->addButton(156, 128, 11410, 11412, 1, 1, 100);
		$this->addText(183, 150, 0, "Deceit");

		$this->addButton(155, 152, 11410, 11412, 1, 3, 101);
		$this->addText(184, 173, 0, "Despise");

		$this->addButton(156, 177, 11410, 11412, 1, 5, 102);
		$this->addText(184, 199, 0, "Destard");

		$this->addButton(156, 203, 11410, 11412, 1, 7, 103);
		$this->addText(184, 223, 0, "Hythloth");

		$this->addButton(156, 227, 11410, 11412, 1, 9, 104);
		$this->addText(184, 248, 0, "Shame");

		$this->addButton(156, 252, 11410, 11412, 1, 11, 105);
		$this->addText(184, 273, 0, "Wrong");

		$this->addButton(156, 276, 11410, 11412, 1, 13, 106);
		$this->addText(184, 300, 0, "Miscellaneous");

		$this->addButton(156, 302, 11410, 11412, 1, 15, 107);
		$this->addButton(142, 90, 5603, 5607, 0, 16, 1);
		$this->addText(179, 89, 0, "Felucca - Dungeons");

		$this->addGumpPic(335, 137, 5593, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addText(184, 322, 0, "Terathan Keep");

		$this->addButton(156, 325, 11410, 11412, 1, 21, 100);
		$this->addText(183, 347, 0, "Fire");

		$this->addButton(155, 349, 11410, 11412, 1, 23, 101);
		$this->addText(184, 370, 0, "Ice");

		$this->addButton(156, 374, 11410, 11412, 1, 25, 102);
		$this->addText(184, 396, 0, "Orc Cave");

		$this->addButton(156, 400, 11410, 11412, 1, 27, 103);
		$this->addText(184, 420, 0, "Solen Hives");

		$this->addButton(156, 424, 11410, 11412, 1, 29, 104);
		$this->addText(184, 445, 0, "Khaldun");

		$this->addButton(156, 449, 11410, 11412, 1, 31, 105);
	}



	public static function callback($client, $buttonId)
	{
		$gps = array();
		switch($buttonId)
		{						
			//Cases 100 - 120 - Felluca's Map
			case 100:
				$gps[] = 1592;
				$gps[] = 1680;
				$gps[] = 10;
				$gps[] = 0;
				
				new TeleCommand($client, $gps);
				break;
			case 105:
				$gps[] = 2471;
				$gps[] = 439;
				$gps[] = 15;
				$gps[] = 0;
				new TeleCommand($client, $gps);
				break;
		}
	}
	
}