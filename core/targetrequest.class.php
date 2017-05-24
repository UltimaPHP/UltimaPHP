<?php

class TargetRequest{
	
	public static function responsed($client, $target)
	{
		
		$player = UltimaPHP::$socketClients[$target['senderSerial']]['account']->player;
		$item = Map::getBySerial($target['objectSerial']);
		
		$object = NULL;		
		
		print_r($target);
		
		if($item)
		{
			$object = $item;
		}elseif ($player)
		{
			$object = $player;
		}
		
		if(!$object)
		{
			new SysmessageCommand($client, ["Please select a valid character or item"]);
			return true;
		}
		
		
	}
	
}

?>