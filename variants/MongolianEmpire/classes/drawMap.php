<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class MongolianEmpireVariant_drawMap extends drawMap {

	/**
	 * An array of colors for different countries, indexed by countryID
	 * @var array
	 */
	protected $countryColors = array(
		 0 => array(226, 198, 158), // Neutral
		 1 => array(114, 146, 103), // Chagatai Khanate
		 2 => array(164, 196, 153), // Crusader States
		 3 => array(147, 162, 208), // Delhi Sultanate
		 4 => array(168, 126, 159), // Golden Horde
		 5 => array(160, 138, 117), // Ilkhanate
		 6 => array(239, 196, 228), // Khmer Empire
		 7 => array(120, 120, 120), // Sirijaya
		 8 => array(234, 234, 175), // The Caliphate
		 9 => array(121, 175, 198), // The Great Khans
		10 => array(206, 153, 103), // Tibet
		11 => array(196, 143, 133), // Yuan Dynasty
		12 => array(255,  20,  20), // Neutral Units
	);

	/**
	 * Resources, all required except names, which will be drawn on by the computer if not supplied.
	 * @return array[$resourceName]=$resourceLocation
	 */
	protected function resources() {
		if( $this->smallmap )
		{
			return array(
				'map'=>'variants/MongolianEmpire/resources/smallmap.png',
				'army'=>'variants/MongolianEmpire/resources/smallarmy.png',
				'fleet'=>'variants/MongolianEmpire/resources/smallfleet.png',
				'names'=>'variants/MongolianEmpire/resources/smallmapNames.png',
				'standoff'=>'images/icons/cross.png'
			);
		}
		else
		{
			return array(
				'map'=>'variants/MongolianEmpire/resources/map.png',
				'army'=>'variants/MongolianEmpire/resources/army.png',
				'fleet'=>'variants/MongolianEmpire/resources/fleet.png',
				'names'=>'variants/MongolianEmpire/resources/mapNames.png',
				'standoff'=>'images/icons/cross.png'
			);
		}
	}

	// No need to set the transparency of the unit icons
	protected function setTransparancies() { }

	public function countryFlag($terrID, $countryID)
	{

		$flagBlackback = $this->color(array(0, 0, 0));
		$flagColor = $this->color($this->countryColors[$countryID]);

		list($x, $y) = $this->territoryPositions[$terrID];

		$coordinates = array(
			'top-left' => array(
						 'x'=>$x-intval($this->fleet['width']/2+1),
						 'y'=>$y-intval($this->fleet['height']/2+1)
						 ),
			'bottom-right' => array(
						 'x'=>$x+intval($this->fleet['width']/2+1),
						 'y'=>$y+intval($this->fleet['height']/2-1)
						 )
		);

		imagefilledrectangle($this->map['image'],
			$coordinates['top-left']['x'], $coordinates['top-left']['y'],
			$coordinates['bottom-right']['x'], $coordinates['bottom-right']['y'],
			$flagBlackback);
		imagefilledrectangle($this->map['image'],
			$coordinates['top-left']['x']+1, $coordinates['top-left']['y']+1,
			$coordinates['bottom-right']['x']-1, $coordinates['bottom-right']['y']-1,
			$flagColor);
	}

}

?>