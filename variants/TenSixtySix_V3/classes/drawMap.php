<?php

defined('IN_CODE') or die('This script can not be run by itself.');

include_once ("variants/TenSixtySix/classes/drawMap.php");

class TenSixtySix_V3Variant_drawMap extends TenSixtySixVariant_drawMap
{
	protected $sea_terrs = array(
		'Central North Sea' , 'Firth of Clyde' , 'North Atlantic Ocean' , 'Mid Atlantic Ocean' , 'Irish Sea',
		'Bristol Channel', 'North English Channel', 'Southwest North Sea', 'Strait of Dover',
		'Thames Estuary' , 'South English Channel', 'Northwest North Sea', 'Skagerrak',
		'Norwegian Sea'  , 'Northeast North Sea'  , 'Southeast North Sea', 'Baltic Sea',
		'Channel Islands', 'Shetland and Orkneys' , 'Heligoland Bight');

	protected function resources() {
		if( $this->smallmap )
		{
			return array(
				'map' =>l_s('variants/TenSixtySix_V3/resources/smallmap.png'),
				'army' =>l_s('contrib/smallarmy.png'),
				'fleet' =>l_s('contrib/smallfleet.png'),
				'names' =>l_s('variants/TenSixtySix_V3/resources/smallmapNames.png'),
				'standoff'=>l_s('images/icons/cross.png')
			);
		}
		else
		{
			return array(
				'map' =>l_s('variants/TenSixtySix_V3/resources/map.png'),
				'army' =>l_s('contrib/army.png'),
				'fleet' =>l_s('contrib/fleet.png'),
				'names' =>l_s('variants/TenSixtySix_V3/resources/mapNames.png'),
				'standoff'=>l_s('images/icons/cross.png')
			);
		}
	}

}

?>
