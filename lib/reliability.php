<?php
/*
    Copyright (C) 2013 Oliver Auth

	This file is part of vDiplomacy.

    vDiplomacy is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    vDiplomacy is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with webDiplomacy.  If not, see <http://www.gnu.org/licenses/>.
*/

class libReliability
{

	/**
	 * Get a user's or members integrity rating.	 
	 * This is cdTakenCount + integrityBalance - (nmrCount * 0.2 + cdCount * 0.6);
	 * @return integrityRating
	 */
	static function integrityRating($User)
	{
		if ($User->gameCount == 0) return 0;
		return $User->cdTakenCount + $User->integrityBalance - (($User->nmrCount * 0.2) + ($User->cdCount * 0.6));
	}
	
	/**
	 * Get a user's Grade... 
	 * @return grade as string... (or Rookie if < 99 phases played)
	 */
	static public function getGrade($User)
	{
		if ($User->phaseCount > 99 && $User->gameCount > 2)
			return "R".round($User->reliabilityRating);
		else
			return 'Rookie';
	}

	static public function gameLimits($User)
	{
		$gLp = $gLi = 999;
		
		if ($User->phaseCount < 100) {$gLp = 7;}
		if ($User->phaseCount < 50)  {$gLp = 4;}
		if ($User->phaseCount < 20)  {$gLp = 2;}
		
		$integrity = self::integrityRating($User);
		if ($integrity <= -1) { $gLi =  6; }
		if ($integrity <= -2) { $gLi =  5; }
		if ($integrity <= -3) { $gLi =  3; }
		if ($integrity <= -4) { $gLi =  1; }
		
		return min($gLp,$gLi);		
	}
	
	/**
	 * Return how many games a user can join.
	 * @return $maxgames as integer or 9999 as no restrictions...
	 */
	static public function maxGames($User)
	{
		global $DB;

		$gL = self::gameLimits($User);
		if ($gL > 100) return 100;
			
		$mG = 100;
		list($totalGames) = $DB->sql_row("SELECT COUNT(*) FROM wD_Members m, wD_Games g WHERE m.userID=".$User->id." and m.status!='Defeated' and m.gameID=g.id and g.phase!='Finished' and m.bet!=1");
		$mG = $gL - $totalGames;
		if ($mG < 0) { $mG = 0; }
		
		// If a user has a timed ban he can 
		if ($User->tempBan > time())
			$mG=0;
			
		return $mG;
	}
	
	/**
	 * 
	 * 
	 */
	static public function printCDNotice($User)
	{
		if ( self::maxGames($User) < 50 )
			print '<p class="notice">Game-Restrictions in effect.</p>
				<p class="notice">You can join or create '.self::maxGames($User).' additional games.<br>
				Read more about this <a href="reliability.php">here</a>.<br><br></p>';
	}
	
	/**
	 * Check if the users reliability is high enough to join/create more games
	 * @return true or error message	 
	 */
	static public function isReliable($User)
	{
		global $DB;
		
		// A player can't join new games, as long as he has active CountrySwiches.
		list($openSwitches)=$DB->sql_row('SELECT COUNT(*) FROM wD_CountrySwitch WHERE (status = "Send" OR status = "Active") AND fromID='.$User->id);
		if ($openSwitches > 0)
			return "<p><b>NOTICE:</b></p><p>You can't join or create new games, as you have active CountrySwitches at the moment.</p>";

		$maxGames = self::maxGames($User);
		
		if ($maxGames == 0)
		{
			if ( self::gameLimits($User) == 2 ) 
				return "<p>You're taking on too many games at once for a new member.<br>
					Please relax and enjoy the games that you are currently in before joining/creating a new one.<br>
					You need to play at least <strong>20 phases</strong>, before you can join more than 2 games.<br>
					2-player variants are not affected by this restriction.</p>
					<p>Read more about this <a href='reliability.php'>here</a>.</p>";
			if ( self::gameLimits($User) == 4 ) 
				return "<p>You're taking on too many games at once for a new member.<br>
					Please relax and enjoy the games that you are currently in before joining/creating a new one.<br>
					You need to play at least <strong>50 phases</strong>, before you can join more than 4 games.<br>
					2-player variants are not affected by this restriction.</p>
					<p>Read more about this <a href='reliability.php'>here</a>.</p>";
			if ( self::gameLimits($User) == 7 ) 
				return "<p>You're taking on too many games at once for a new member.<br>
					Please relax and enjoy the games that you are currently in before joining/creating a new one.<br>
					You need to play at least <strong>100 phases</strong>, before you can join more than 7 games.<br>
					2-player variants are not affected by this restriction.</p>
					<p>Read more about this <a href='reliability.php'>here</a>.</p>";
					
			return "<p>NOTICE: You cannot join or create a new game, because you seem to be having trouble keeping up with the orders in the ones you already have.</p>
				<p>Read more about this <a href='reliability.php'>here</a>.</p>";
		}
	}

}

?>
