<?php
/*
	Copyright (C) 2010 Oliver Auth, Orathaic

	This file is part of the Italy+ Vs England+ Vs Russia variant for webDiplomacy

	The Italy+ Vs England+ Vs Russia variant for webDiplomacy is free software: you can redistribute
	it and/or modify it under the terms of the GNU Affero General Public License
	as published by the Free Software Foundation, either version 3 of the License,
	or (at your option) any later version.

	The France Vs Germany Vs Austria variant for webDiplomacy is distributed in the hope that it will
	be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of 
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	See the GNU General Public License for more details.

	You should have received a copy of the GNU Affero General Public License
	along with webDiplomacy. If not, see <http://www.gnu.org/licenses/>.
	
*/

defined('IN_CODE') or die('This script can not be run by itself.');

class ClassicEvTVariant_adjudicatorPreGame extends adjudicatorPreGame {

	protected $countryUnits = array(
		'England'  => array('North Sea'  =>'Fleet', 'London' =>'Army', 'English Channel'=>'Fleet'),
		'Turkey' => array('Smyrna'=>'Army', 'Constantinople'=>'Army', 'Ankara'  =>'Fleet')

	);

}
