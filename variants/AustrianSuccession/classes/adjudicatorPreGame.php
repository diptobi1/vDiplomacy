<?php
/*
	Copyright (C) 2015 Oliver Auth / Safari

	This file is part of the War of Austrian Succession variant for webDiplomacy

	The War of Austrian Succession variant for webDiplomacy is free software: you can redistribute
	it and/or modify it under the terms of the GNU Affero General Public License 
	as published by the Free Software Foundation, either version 3 of the License,
	or (at your option) any later version.

	The War of Austrian Succession variant for webDiplomacy is distributed in the hope that it will be
	useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
	See the GNU General Public License for more details.

	You should have received a copy of the GNU Affero General Public License
	along with webDiplomacy. If not, see <http://www.gnu.org/licenses/>.

*/

defined('IN_CODE') or die('This script can not be run by itself.');

class AustrianSuccessionVariant_adjudicatorPreGame extends adjudicatorPreGame {

	protected $countryUnits = array(
		'Austria' => array('Vienna'=>'Army', 'Croatia'=>'Army', 'Budapest'=>'Army'),
		'Bavaria' => array('Regensburg'=>'Army', 'Munich'=>'Army'),
		'England' => array('London'=>'Fleet', 'Bristol'=>'Army', 'Scotland'=>'Fleet'),
		'France' => array('Bordeaux'=>'Army', 'Rouen'=>'Army' , 'Brest'=>'Fleet'),
		'Ottoman Empire' => array('Greece'=>'Fleet', 'Bulgaria'=>'Army', 'Constantinople'=>'Army'),
		'Piedmont-Sardinia' => array('Piedmont'=>'Fleet', 'Sardinia'=>'Army', 'Savoy'=>'Army'),
		'Prussia' => array('Berlin'=>'Army', 'Stettin'=>'Army'),
		'Russia' => array('St. Petersburg'=>'Fleet', 'Moscow'=>'Army', 'Kiev'=>'Army'),
		'Spain' => array('Valencia'=>'Fleet', 'Madrid'=>'Army', 'Seville'=>'Army'),
	);

}

?>