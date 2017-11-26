<?php
/*
	Copyright (C) 2017 Oliver Auth

	This file is part of the Imperium variant for webDiplomacy

	The Imperium variant for webDiplomacy is free software: you can redistribute
	it and/or modify it under the terms of the GNU Affero General Public License
	as published by the Free Software Foundation, either version 3 of the License,
	or (at your option) any later version.

	The Imperium variant for webDiplomacy is distributed in the hope that it will
	be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of 
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	See the GNU General Public License for more details.

	You should have received a copy of the GNU Affero General Public License
	along with webDiplomacy. If not, see <http://www.gnu.org/licenses/>.

*/

defined('IN_CODE') or die('This script can not be run by itself.');

class ImperiumVariant_adjMove extends adjMove
{

	// because it's private, the original defenderMoving can not accessed in the child...
	private function defenderMoving()
	{
		return parent::defenderMoving();
	}
	
	protected function _preventStrength()
	{
		global $Game;
		$prevent = parent::_preventStrength();
		// If we're not moving across a river, reduce the strength
		if (!(in_array($this->id, $Game->Variant->river_moves)))
		{
			$prevent['min']++;
			$prevent['max']++;
		}
		return $prevent;
	}
	
	protected function _attackStrength()
	{
		global $Game;
		$attack = parent::_attackStrength();
		// Check rivers before returning attack
		if (!( in_array($this->id, $Game->Variant->river_moves) ))
		{
			$attack['min']++;
			$attack['max']++;
		}
		return $attack;
	}
	
}

?>