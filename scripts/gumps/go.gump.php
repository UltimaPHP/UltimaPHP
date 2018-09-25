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
 		$this->addPage(1);
		$this->addBackground(114, 57, 642, 505, 302);
		$this->addButton(278, 153, 5601, 5605, 0, 2, 1);
		$this->addText(199, 152, 0, "Felucca");
 		$this->addGumpPic(335, 137, 5593, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addText(185, 208, 0, "Towns");
 		$this->addText(187, 243, 0, "Dungeons");
 		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");
 		$this->addButton(156, 211, 11410, 11412, 1, 0, 8);
		$this->addButton(156, 246, 11410, 11412, 1, 0, 9);
 		$this->addPage(2);
		$this->addBackground(114, 57, 642, 505, 302);
		$this->addGumpPic(335, 137, 5594, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 1, 3);
		$this->addButton(278, 153, 5601, 5605, 0, 3, 4);
		$this->addText(199, 152, 0, "Trammel");
 		$this->addText(185, 208, 0, "Towns");
 		$this->addText(187, 243, 0, "Dungeons");
 		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");
 		$this->addButton(156, 211, 11410, 11412, 1, 0, 9);
		$this->addButton(156, 246, 11410, 11412, 1, 0, 10);
 		$this->addPage(3);
		$this->addBackground(114, 57, 642, 505, 302);
		$this->addGumpPic(335, 137, 5595, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 2, 3);
		$this->addButton(278, 153, 5601, 5605, 0, 4, 4);
		$this->addText(199, 152, 0, "Ilshenar");
 		$this->addText(185, 208, 0, "Towns");
 		$this->addText(187, 243, 0, "Dungeons");
 		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");
 		$this->addButton(156, 211, 11410, 11412, 1, 0, 9);
		$this->addButton(156, 246, 11410, 11412, 1, 0, 10);
 		$this->addPage(4);
		$this->addBackground(114, 57, 642, 505, 302);
		$this->addGumpPic(335, 137, 5596, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 3, 3);
		$this->addButton(278, 153, 5601, 5605, 0, 5, 4);
		$this->addText(199, 152, 0, "Malas");
 		$this->addText(185, 208, 0, "Towns");
 		$this->addText(187, 243, 0, "Dungeons");
 		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");
 		$this->addButton(156, 211, 11410, 11412, 1, 0, 9);
		$this->addButton(156, 245, 11410, 11412, 1, 0, 10);
 		$this->addPage(5);
		$this->addBackground(114, 57, 642, 505, 302);
		$this->addGumpPic(335, 137, 5597, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 4, 3);
		$this->addButton(278, 153, 5601, 5605, 0, 6, 4);
		$this->addText(199, 152, 0, "Tokuno");
 		$this->addText(185, 208, 0, "Towns");
 		$this->addText(187, 243, 0, "Dungeons");
 		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");
 		$this->addButton(156, 211, 11410, 11412, 1, 0, 9);
		$this->addButton(156, 246, 11410, 11412, 1, 0, 10);
 		$this->addPage(6);
		$this->addBackground(114, 57, 642, 505, 302);
		$this->addGumpPic(335, 137, 5598, 0);
		$this->addGumpPic(331, 131, 5599, 0);
		$this->addButton(144, 153, 5603, 5607, 0, 5, 3);
		$this->addText(199, 152, 0, "TerMur");
 		$this->addText(185, 208, 0, "Towns");
 		$this->addText(187, 243, 0, "Dungeons");
 		$this->addText(379, 88, 0, "Ultima PHP - Menu Go");
 		$this->addButton(848, 215, 9009, 9008, 1, 0, 8);
		$this->addButton(156, 211, 11410, 11412, 1, 0, 9);
		$this->addButton(156, 246, 11410, 11412, 1, 0, 10);
	}
}