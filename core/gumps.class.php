<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Gumps {
    public $id;
    private $client;
    private $pages = [];
    private $x, $y, $noMove, $noClose, $noDispose, $type;
    public $layout, $text;
    public $gumpId = 0;

    /**
     * Dialog basic methods
     */
    public function __construct($client = false) {
        if (!$client) {
            return false;
        }
        
        $this->setType(1);
        $this->setNoClose(false);
        $this->setNoDispoe(false);
        $this->setNoMove(false);
        $this->setX(50);
        $this->setY(50);
        $this->client = $client;
    }
    
    public function setX($x)
    {
        $this->x = $x;        
    }
    
    public function getX()
    {
        return $this->x;
    }
    
    public function setY($y)
    {
        $this->y = $y;        
    }
    
    public function getY()
    {
        return $this->y;
    }
    
    public function setNoClose($noClose)
    {
        $this->noClose = $noClose;        
    }
    
    public function getNoClose()
    {
        return $this->noClose;
    }
    
    public function setNoMove($noMove)
    {
        $this->noMove = $noMove;        
    }
    
    public function getNoMove()
    {
        return $this->noMove;
    }
    
    public function setNoDispoe($noDispose)
    {
        $this->noDispose = $noDispose;        
    }
    
    public function getNoDispose()
    {
        return $this->noDispose;
    }
    
    public function getLayout()
    {
        return $this->layout;
    }
    
    public function getText()
    {
        return $this->text;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getType()
    {
        return $this->type;
    }

    /**
     * Send the compressed packet 0xDD to the client
     */
    public function show() {

    }

    /**
     * Send the close dialog packet to the client
     */
    public function close() {

    }

    /**
     * Updates dialog view to the player
     */
    public function update() {

    }

    /**
     * Build the layout information format and then compress in huffman table
     */
    private function compressLayout() {

    }

    /**
     * Build the text information format and then compress in huffman table
     */
    private function compressTexts() {

    }

    /**
     * Dialog building methods
     */        
    
    /* {page 1} */        
    public function addPage( $pageId = 0 )
    {
        $this->layout .= "{page ".$pageId."}";	
    }
    
    public function addTilePic( $tileX, $tileY, $tileId, $hue = 0)
    {
	$tilepic = "{tilepic ".$tileX." ".$tileY." ".$tileId." ".$hue."}";
        $this->layout .= $tilepic;
    }

    /* {gumppictiled 50 155 170 230 2624} */
    public function addTiledGump( $gumpX, $gumpY, $width, $height, $gumpId, $hue )
    {
        $hue = ($hue != -1 ? $hue : "");
	$gumppictiled = "{gumppictiled ".$gumpX." ".$gumpY." ".$gumpId." ".$width." ".$height." ".$hue."}";
        $this->layout .= $gumppictiled;
    }

    /* {checkertrans 50 155 170 230} */
    public function addCheckerTrans($x, $y, $width , $height = 1, $page = 0) {
        
        $checkertrans = "{checkertrans ".$x." ".$y." ".$width." ".$height."}";
        $this->layout .= $checkertrans;
        
    }
    
    public function addRawText( $data )
    {
	// Do we already have the text?
	if ( strpos($this->text, $data) !== false )
            $this->text .= $data ;

	return strpos($this->text, $data);
    }

    /* {gumppic 451 74 10441} */
    public function addGump( $gumpX, $gumpY, $gumpId, $hue = 0 )
    {
	$gumppic = "{gumppic ".$gumpX." ".$gumpY." ".$gumpId." ".$hue."}" ;
        $this->layout .= $gumppic;
    }

    /* {htmlgump 52 130 408 20 0 0 0} */
    public function addHtmlGump($x, $y, $width, $height, $html, $hashBack, $canScroll, $text = null, $page = 0) 
    {
        $hashBack = ($hashBack === true ? 1 : 0);
        $canScroll = ($canScroll === true ? 1 : 0);
        $html = $this->addRawText( $html );
	$htmlGump = "{htmlgump ".$x." ".$y." ".$width." ".$height." ".$html." ".$hashBack." ".$canScroll."}" ;
	$this->layout .= $htmlGump;
    }
    
    public function addXmfHtmlGump( $x, $y, $width, $height, $clilocid, $hasBack, $canScroll )
    {
        $hashBack = ($hashBack === true ? 1 : 0);
        $canScroll = ($canScroll === true ? 1 : 0);
	$xmlhtmlgump = "{xmfhtmlgump ".$x." ".$y." ".$width." ".$height." ".$clilocid." ".$hasBack." ".$canScroll."}";
	$this->layout .= $xmlhtmlgump;
    }

    /* {text 90 173 1152 1} */
    public function addText( $textX, $textY, $data, $hue = 0)
    {
        $data = $this->addRawText($data);
        $text = "{text ".$textX." ".$textY." ".$data." ".$hue."}";
        $this->layout .= $text;
    }
    
    /* {button 70 176 2117 2118 0 1 0} */
    public function addButton( $buttonX, $buttonY, $gumpUp, $gumpDown, $returnCode )
    {
	$button = "{button ".$buttonX." ".$buttonY." ".$gumpUp." ".$gumpDown." ".$returnCode."}";
	$this->layout .= $button;
    }
    
    public function addPageButton( $buttonX, $buttonY, $gumpUp, $gumpDown, $pageId )
    {
	$pagebutton = "{button ".$buttonX." ".$buttonY." ".$gumpUp." ".$gumpDown." 0 ".$pageId." 0}";
        $this->layout .= $pagebutton;	
    }
    
    public function addResizeGump( $gumpX, $gumpY, $gumpId, $width, $height )
    {
	$resizepic = "{resizepic ".$gumpX." ".$gumpY." ".$gumpId." ".$width." ".$height."}" ;
        $this->layout .= $resizepic;
    }
    
    public function addCroppedText( $textX, $textY, $width, $height, $data, $hue )
    {   
        $data = $this->addRawText($data);
        $croppedtext = "{croppedtext ".$textX." ".$textY." ".$width." ".$height." ".$data." ".$hue."}";
        $this->layout .= $croppedtext;
    }
    
    public function startGroup( $groupId = 0 )
    {
        $this->layout .= "{group ".$groupId."}";
    }
    
    public function addBackground( $gumpId, $width, $height )
    {
	$background = "{resizepic 0 0 ".$gumpId." ".$width." ".$height."}";
        $this->layout .= $background;
    }
    
    // Form-fields
    // 7 = x,y,widthpix,widthchars,wHue,TEXTID,startstringindex
    public function addInputField( $textX, $textY, $width, $height, $textId, $data, $hue = 0 )
    {
        $data = $this->addRawText($data);
        $textentry = "{textentry ".$textX." ".$textY." ".$width." ".$height." ".$textId." ".$data." ".$hue."}";
        $this->layout .= $textentry;
    }
    
    public function addCheckbox( $checkX, $checkY, $gumpOff, $gumpOn, $returnVal, $checked = false )
    {
        $checked = ($checked ? 1 : 0);
        $checkbox = "{checkbox ".$checkX." ".$checkY." ".$gumpOff." ".$gumpOn." ".$checked." ".$returnVal." }";
        $this->layout .= $checkbox;
    }
    
    public function addRadioButton( $radioX, $radioY, $gumpOff, $gumpOn, $returnVal, $checked = false )
    {
        $checked = ($checked ? 1 : 0);
        $radio = "{radio ".$radioX." ".$radioY." ".$gumpOff." ".$gumpOn." ".$checked." ".$returnVal." }";
        $this->layout .= $radio;
    }
}