<?php
/*
	Copyright (C) 2011 Oliver Auth / 2014 Tobias Florin

	This file is part of the Duo variant for webDiplomacy

	The Duo variant for webDiplomacy is free software: you can redistribute
	it and/or modify it under the terms of the GNU Affero General Public License
	as published by the Free Software Foundation, either version 3 of the License,
	or (at your option) any later version.

	The Duo variant for webDiplomacy is distributed in the hope that it will
	be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	See the GNU General Public License for more details.

	You should have received a copy of the GNU Affero General Public License
	along with webDiplomacy. If not, see <http://www.gnu.org/licenses/>.

*/

defined('IN_CODE') or die('This script can not be run by itself.');

class TransSib_OrderArchiv extends OrderArchiv
{
	public function OutputOrder($order)
	{
		if ($order['type'] == 'move' && $order['viaConvoy'] == 'No' && isset($order['fromTerrID']) && isset($order['toTerrID']) && $order['countryID'] == 6) //We have a TSR order
		{
			$buffer = '<li>';

                        if ($order['dislodged'] == 'Yes' || $order['success'] == 'No')
                                $buffer .= '<u>';       // underline failed orders


			$buffer .= l_t("The %s at %s %s",l_t($order['unitType']),l_t($this->terrIDToName[$order['terrID']]),l_t($order['type'])).
					l_t(" to %s",l_t($this->terrIDToName[$order['toTerrID']])).
					l_t(" via Trans-Siberian Railroad").
								($order['toTerrID'] != $order['fromTerrID'] ? " (".l_t("tried to reach %s", l_t($this->terrIDToName[$order['fromTerrID']])).")" : "");
					

                        $buffer .= '.';

                        if ($order['dislodged'] == 'Yes' || $order['success'] == 'No')
                        {
                                $buffer .= '</u>';

                                if ($order['success'] == 'No')
                                        $buffer .= ' ('.l_t('fail').')';
                                
                                if ($order['dislodged'] == 'Yes')
                                        $buffer .= ' ('.l_t('dislodged').')';
                        }

                        $buffer .= '</li>';

                        return $buffer;	
                        
		} else return parent::OutputOrder($order);
	}
}

class SuezCanal_OrderArchiv extends TransSib_OrderArchiv
{
        public function __construct()
	{
		parent::__construct();
		$this->countryIDToName[]='Suez Canal';
	}
        
        public function OutputOrder($order) {
                if($order['terrID'] == '126')
                {
                        $buffer = '<li>';

                        if($order['type'] == 'hold')
                                $buffer .= l_t("No fleet is allowed to use the Suez Canal");
                        elseif($order['type'] == 'support hold')
                                $buffer .= l_t("The fleet in %s is allowed to use the Suez Canal",l_t($this->terrIDToName[$order['toTerrID']]));

                        $buffer .= '.';

                        $buffer .= '</li>';

                        return $buffer;	     
                } 
                else return parent::OutputOrder($order);
        }
}

class ColonialVariant_OrderArchiv extends SuezCanal_OrderArchiv {}
