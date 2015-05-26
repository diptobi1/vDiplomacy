<?php
/*
    Copyright (C) 2004-2010 Kestas J. Kuliukas

	This file is part of webDiplomacy.

    webDiplomacy is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    webDiplomacy is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with webDiplomacy.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('IN_CODE') or die('This script can not be run by itself.');

require_once(l_r('gamepanel/members.php'));
require_once('lib/reliability.php');

/**
 * The game panel class; it extends the Game class, which contains the information, with a set
 * of functions which display HTML giving info on the game and allowing certain interactions with it.
 *
 * This class is also extended to behave differently when viewed in a game board, or on the user's home
 * page. The plain class is used on the game-listings and profile page.
 *
 * The panelGame class has corresponding panelMembers and panelMember classes, which extend Members
 * and Member in similar ways.
 *
 * Nothing in panelGame will change the objects being displayed in any way, however they may provide
 * interfaces to do so (e.g. voting, leaving, joining), but other code like board.php will actually
 * act on any received form data; these classes are for display only.
 *
 * With a few exceptions all panel* functions return HTML strings. Also the convention is that if
 * HTML data is enclosed in a <div> it will leave its caller to create the div for it. So
 * '<div class="titleBar">'.$this->titleBar().'</div>' is seen, instead of titleBar() adding the div
 * itself.
 *
 * @package GamePanel
 */
class panelGame extends Game
{
	/**
	 * print the HTML for this game panel; header, members info, voting info, links
	 */
	function summary()
	{
		print '
		<div class="gamePanel variant'.$this->Variant->name.'">
			'.$this->header().'
			'.$this->description().'
			'.$this->members().'
			'.$this->votes().'
			'.$this->links().'
			<div class="bar lastBar"> </div>
		</div>
		';
	}

	public function __construct($gameData)
	{
		parent::__construct($gameData);
	}

	/**
	 * Load panelMembers, instead of Members
	 */
	function loadMembers()
	{
		$this->Members = $this->Variant->panelMembers($this);
	}

	/**
	 * The full bar with a notice about the game; used for game-over and game-starting details.
	 *
	 * @return string
	 */
	function gameNoticeBar()
	{
		if( $this->phase == 'Finished' )
			return $this->gameGameOverDetails();
		elseif( $this->phase == 'Pre-game' && count($this->Members->ByID)==count($this->Variant->countries) )
		{
			if ( $this->isLiveGame() )
				return l_t('%s players joined; game will start at the scheduled time', count($this->Variant->countries));
			else
				return l_t('%s players joined; game will start on next process cycle', count($this->Variant->countries));
		}
		elseif( $this->missingPlayerPolicy=='Wait'&&!$this->Members->isCompleted() && time()>=$this->processTime )
			return l_t("One or more players need to complete their orders before this wait-mode game can go on");
	}

	/*
	 * This is a cute way of displaying the current phase as highlighted out of the list
	 * of available ones, which become smaller, but it took up too much space
	function titleBarPhase()
	{
		return ;
		if( $this->phase == 'Pre-game' || $this->phase == 'Builds' )
			return $this->phase;

		$activePhases = array(
			'Diplomacy'=>'<span class="gamePhaseInactive">Diplomacy</span>',
			'Retreats'=>'<span class="gamePhaseInactive">Retreats</span>'
		);

		if( ($this->turn%2) != 0 )
			$activePhases['Builds']='<span class="gamePhaseInactive">Builds</span>';

		$activePhases[$this->phase] = $this->phase;

		return implode(' - ',$activePhases);
	}
	*/

	function pausedInfo() {
		return l_t('Paused').' <img src="'.l_s('images/icons/pause.png').'" title="'.l_t('Game paused').'" />';
	}

	/**
	 * The next-process data, depending on whether paused/crashed/finished/etc
	 *
	 * @return string
	 */
	function gameTimeRemaining()
	{

		if( $this->phase == 'Finished' )
			return '<span class="gameTimeRemainingNextPhase">'.l_t('Finished:').'</span> '.
				libTime::text($this->processTime);

		if( $this->processStatus == 'Paused' )
			return $this->pausedInfo();
		elseif( $this->processStatus == 'Crashed' )
			return l_t('Crashed');

		if (!isset($timerCount))
			static $timerCount=0;
		$timerCount++;

		if( $this->phase == 'Pre-game' )
		{
			$buf = '<span class="gameTimeRemainingNextPhase">';
			if( $this->fixStart == 'Yes' )
				$buf .= l_t('Start:').'</span> '.$this->processTimetxt().' ('.libTime::text($this->processTime).')';
			else
				$buf .= l_t('Start: <b>If full</b> - Expires: ').' </span>'.$this->processTimetxt().' ('.libTime::text($this->processTime).')</span>';
		}	
		else
		{
			$buf = '<span class="gameTimeRemainingNextPhase">'.l_t('Next:').'</span> '.
				$this->processTimetxt().' ('.libTime::text($this->processTime).')';

			//if ( $this->Members->isJoined() )
				//$buf .= ' <span class="gameTimeRemainingFixed">('.libTime::text($this->processTime).')</span>';

		}

		return $buf;
	}

	/**
	 * What circumstances did the game end in? Who won, etc
	 * @return string
	 */
	function gameGameOverDetails()
	{
		if( $this->gameOver == 'Won' )
		{
			foreach($this->Members->ByStatus['Won'] as $Winner);
			return l_t('Game won by %s',$Winner->memberName());
		}
		elseif( $this->gameOver == 'Drawn' )
		{
			return l_t('Game drawn');
		}
	}

	/**
	 * Game name
	 * @return string
	 */
	function titleBarName()
	{
		return $this->name;
	}

	/**
	 * Icons for the game, e.g. private padlock and featured star
	 * @return string
	 */
	function gameIcons()
	{
		global $Misc;

		$buf = '';
		if( $this->pot > $Misc->GameFeaturedThreshold )
			$buf .= '<img src="'.l_s('images/icons/star.png').'" alt="'.l_t('Featured').'" title="'.l_t('This is a featured game, one of the highest stakes games on the server!').'" /> ';

		if( $this->adminLock == 'Yes' )
			$buf .= '<img src="images/icons/lock.png" alt="Locked" title="Game is currently locked by an admin (usually to fix some errors)." /> ';
			
		if( $this->private )
			$buf .= '<img src="'.l_s('images/icons/lock.png').'" alt="'.l_t('Private').'" title="'.l_t('This is a private game; password needed!').'" /> ';

		return $buf;
	}

	/**
	 * The title bar, giving the vital game related data
	 *
	 * @return string
	 */
	function titleBar()
	{
		$rightTop = '
			<div class="titleBarRightSide">
				<span class="gameTimeRemaining">'.$this->gameTimeRemaining().'</span>
			</div>
			';

		$rightBottom = '<div class="titleBarRightSide">
				<span class="gameHoursPerPhase">
					'.$this->gameHoursPerPhase().'
				</span>
			</div>';
			
		$date='<span class="gameDate">'.$this->datetxt().'</span>, <span class="gamePhase">';
		
		if ($this->phase == 'Pre-game')
		{
			$needed = count($this->Variant->countries) - count($this->Members->ByID);
			$date .= '<b>'.$needed.'</b> player'.($needed == 1 ? '' : 's').' (of '.count($this->Variant->countries).') missing</span>';
		}
		else
			$date .= l_t($this->phase).'</span>';

		$leftTop = '<div class="titleBarLeftSide">
				'.$this->gameIcons().
				'<span class="gameName">'.$this->titleBarName().'</span>';

		$leftBottom = '<div class="titleBarLeftSide">';

		
		if ($this->pot > 0 || ($this->pot == 0 && count($this->Members->ByID) == 0 && $this->minimumBet != 0) )
			$leftBottom .= l_t('Pot:').' <span class="gamePot">'.$this->pot.' '.libHTML::points().'</span> - ';
			//<span class="gamePotType" title="'.$this->potType.'">('.($this->potType=='Points-per-supply-center'?'PPSC':'WTA').')</span>';
		else
			$leftBottom .= '<i><a class="light" href="features.php#4_4">'.l_t('Unrated').'</a></i> - ';

		$leftBottom .= $date;

		$leftTop .= '</div>';
		$leftBottom .= '</div>';

		$buf = '
			'.$rightTop.'
			'.$leftTop.'
			<div style="clear:both"></div>
			'.$rightBottom.'
			'.$leftBottom.'
			<div style="clear:both"></div>
			';

		$buf .= $this->gameVariants();

		return $buf;
	}

	function gameVariants() {
	
		global $User;
		
		$alternatives=array();
		if( $this->variantID!=1 )
			$alternatives[]=$this->Variant->link();
		if( $this->potType=='Winner-takes-all' && $this->pot > 0 )
			$alternatives[]='<b><a href="points.php#ppscwta">'.l_t('WTA').'</a></b>';
		elseif ($this->potType=='Points-per-supply-center' && $this->pot > 0 )
			$alternatives[]='<b><a href="points.php#ppscwta">'.l_t('PPSC').'</a></b>';
		if( $this->pressType=='NoPress')
			$alternatives[]=l_t('Gunboat');
		elseif( $this->pressType=='PublicPressOnly' )
			$alternatives[]=l_t('Public Press');
		if( $this->anon=='Yes' )
			$alternatives[]=l_t('Anon');
		if( $this->chooseYourCountry=='Yes' )
			$alternatives[]=l_t('ChooseYourCountry');
		if( $this->chessTime > 0)
			$alternatives[]=l_t('Chess:'.$this->chessTime." min.");
			
		// The NMR-policy defaults
		if( ($this->specialCDturn != Config::$specialCDturnsDefault || $this->specialCDcount != Config::$specialCDcountDefault) && $this->specialCDturn >= $this->turn)
		{
			if ( $this->specialCDturn == 0 )
				$alternatives[]=l_t('NMR: Off');
			elseif( $this->specialCDturn == 5  && $this->specialCDcount == 2 )
				$alternatives[]=l_t('NMR: Committed');
			elseif( $this->specialCDturn > 90 && $this->specialCDcount > 90 )
				$alternatives[]=l_t('NMR: Serious');
			else
			
				$alternatives[]='NMR:'.($this->specialCDturn > 90 ? '&infin;' : $this->specialCDturn).'/'.($this->specialCDcount > 90 ? '&infin;' : ($this->specialCDcount == 0 ? 'off' : $this->specialCDcount));
		}
		
		//	Show the end of the game in the options if set.
		if(( $this->targetSCs > 0) && ($this->maxTurns > 0))
			$alternatives[]='EoG: '.$this->targetSCs.' SCs or "'.$this->Variant->turnAsDate($this->maxTurns -1).'"';
		elseif( $this->maxTurns > 0)
			$alternatives[]='EoG: "'.$this->Variant->turnAsDate($this->maxTurns -1).'"';
		elseif( $this->targetSCs > 0)
			$alternatives[]='EoG: '.$this->targetSCs.' SCs';
			
		if( $this->rlPolicy=='Friends')
			$alternatives[]=l_t('OnlyFriends');
		if( $this->missingPlayerPolicy=='Wait' )
			$alternatives[]=l_t('Wait for orders');
			
		if( $this->noProcess != '')
			$alternatives[]=l_t('noProcess:'.str_replace(array('1', '2', '3', '4', '5', '6', '0'), 
					array(l_t('Mon'), l_t('Tue'), l_t('Wed'), l_t('Thu'), l_t('Fri'), l_t('Sat'), l_t('Sun')), $this->noProcess));

		if ( $alternatives )
			return '<div class="titleBarLeftSide" style="float:left">
				<span class="gamePotType">'.implode(', ',$alternatives).'</span>
				</div>
			<div style="clear:both"></div>
			';
		else
			return '';
	}

	/**
	 * Hours per phase, whether the game is slow or fast etc
	 * @return string
	 */
	function gameHoursPerPhase()
	{
		$buf = l_t('<strong>%s</strong> /phase',libTime::timeLengthText($this->phaseMinutes*60)).
			' <span class="gameTimeHoursPerPhaseText">(';

		if ( $this->isLiveGame() && $this->fixStart == 'No' )
			$buf .= l_t('live');
		elseif ( $this->phaseMinutes < 6*60 )
			$buf .= l_t('very fast');
		elseif ( $this->phaseMinutes < 16*60 )
			$buf .= l_t('fast');
		elseif ( $this->phaseMinutes < 36*60 )
			$buf .= l_t('normal');
		elseif ( $this->phaseMinutes < 3*24*60 )
			$buf .= l_t('slow');
		else
			$buf .= l_t('very slow');

		return $buf .')</span>';
	}

	/**
	 * The notifications list, not yet used, for showing notifications data related to a game within its game-panel
	 * @return string
	 */
	function notificationsList()
	{
		return '';
		return '<div class="notification">
					<span class="date"></span>
					<span class="message"></span>
				</div>';
	}

	/**
	 * Votes form data, only available in the board and if a member, so returns nothing here
	 * @return string
	 */
	function votes()
	{
		return '';
	}

	/**
	 * The header; the vital game info and the vital notice bar
	 * @return string
	 */
	function header()
	{
		$buf = '<div class="bar titleBar"><a name="gamePanel"></a>
				'.$this->titleBar().'
			</div>';

		$noticeBar = $this->gameNoticeBar();
		if ( $noticeBar )
			return $buf.'
				<div class="bar gameNoticeBar barAlt'.libHTML::alternate().'">
					'.$noticeBar.'
				</div>';
		else
			return $buf;
	}

	/**
	 * Members data; info about each member is given surrounded by the occupation-bar
	 * @return string
	 */
	function members()
	{
		$occupationBar = $this->Members->occupationBar();
		$buf = '';
		if ($this->moderatorSeesMemberInfo()) 
		{                                                
                	$buf .= '<div class="bar titleBar modEyes">Anonymous</div>';
		}
		$buf .= '<div class="panelBarGraph occupationBar">
				'.$occupationBar.'
			</div>
			<div class="membersList membersFullTable'.($this->moderatorSeesMemberInfo() ? ' modEyes': '').'">
				'.$this->Members->membersList().'
			</div>
			<div class="panelBarGraph occupationBar">
				'.$occupationBar.'
			</div>';
		return $buf;
	}

	/**
	 * The links allowing players to join/view games and see the archive data
	 * @return string
	 */
	function links()
	{
		$buf = '
			<div class="bar enterBar">
				<div class="enterBarJoin">
					'.$this->joinBar().'
				</div>
				<div class="enterBarOpen">
					'.$this->openBar().'
				</div>
				<div style="clear:both"></div>
			</div>
			';

		return $buf;
	}

	/**
	 * Links to the games archived data, maps/orders/etc
	 * @return string
	 */
	function archiveBar()
	{
		return '<strong>'.l_t('Archive:').'</strong> '.
			'<a href="board.php?gameID='.$this->id.'&amp;viewArchive=Orders">'.l_t('Orders').'</a>
			- <a href="board.php?gameID='.$this->id.'&amp;viewArchive=Maps">'.l_t('Maps').'</a>
			- <a href="board.php?gameID='.$this->id.'&amp;viewArchive=Messages">'.l_t('Messages').'</a>';
//			- <a href="board.php?gameID='.$this->id.'&amp;viewArchive=Reports">Reports</a>';
	}

	/**
	 * The password box for joining private games
	 * @return string
	 */
	private static function passwordBox()
	{
		return ' <span class="gamePasswordBox"><label>'.l_t('Password:').'</label> <input type="password" name="gamepass" size="10" /></span> ';
	}

	/**
	 * A bar with form buttons letting you join/leave a game
	 * @return string
	 */
	function joinBar()
	{
		global $DB,$User;

		if ( $this->Members->isJoined() )
		{
			if ( $this->phase == 'Pre-game' )
			{
				$reason=$this->Members->cantLeaveReason();

				if($reason)
					return l_t("(Can't leave game; %s.)",$reason);
				else
					return '<form onsubmit="return confirm(\''.l_t('Are you sure you want to leave this game?').'\');" method="post" action="board.php?gameID='.$this->id.'"><div>
					<input type="hidden" name="formTicket" value="'.libHTML::formTicket().'" />
					<input type="submit" name="leave" value="'.l_t('Leave game').'" class="form-submit" />
					</div></form>';
			}
			else
				return '';
		}
		elseif ( !$this->isJoinable() )
			return '';

		if( $this->minimumBet <= 100 && !$User->type['User'] && !$this->private )
			return l_t('A newly registered account can join this game; '.
				'<a href="register.php" class="light">register now</a> to join.');

		if ( $this->isLiveGame() && $this->fixStart == 'No' )
		{
			$question = l_t('This is a live game.').'\n'.l_t('The game will start at the scheduled time even if all %s players have joined.', count($this->Variant->countries));
		}
		else
		{
			if ($this->fixStart == 'No')
				$question = l_t('The game will start when all %s players have joined.', count($this->Variant->countries));
			else
				$question = l_t('The game will start at the scheduled time even if all %s players have joined.', count($this->Variant->countries));
			
			list($turns,$games) = $DB->sql_row('SELECT SUM(turn), COUNT(*) FROM wD_Games WHERE variantID='.$this->Variant->id.' AND phase = "Finished"');
			if ($games > 3)
			{
				$avgDur = libTime::timeLengthText((($turns / $games) - $this->turn) * 2.5 * $this->phaseMinutes * 60 );
				if ($avgDur > 0)
					$question .= '\n'.l_t('Looking at our stats this game might take (roughly) %s to complete.',$avgDur) ;
			}
			
		}
		
		$question .= '\n\n'.l_t('Are you sure you want to join this game?').'\n';		

		$buf = '<div>';
		// Show join requirements:
		if (($this->minRating > 0) || ($this->minPhases > 0)  || ($this->minNoCD > 0)  || ($this->minNoNMR > 0 ))
		{
			$buf .= '<em>Requirements:</em> ';
			if( $this->minRating > 0)
				$buf .= 'RR >= <em>'.libReliability::Grade($this->minRating).'</em> / ';
			if( $this->minPhases > 0)
				$buf .= 'MinPhases > <em>'.(int)($this->minPhases - 1) .'</em> / ';
			if( $this->minNoCD > 0)
				$buf .= 'NoCD > <em>'.(int)($this->minNoCD - 1) .'%</em> / ';
			if( $this->minNoNMR > 0)
				$buf .= 'NoNMR > <em>'.(int)($this->minNoNMR - 1) .'%</em> / ';
			$buf= substr($buf,0,-2)." - ";
		}

		// Exit and do not show join button if the player should not be able to join a given game.
		require_once(l_r('lib/reliability.php'));		 
//		if (libReliability::getReliability($User) < $this->minRating) return substr($buf,0,-3)."</div>";
		if ($User->phasesPlayed < $this->minPhases) return substr($buf,0,-3)."</div>";
		if (libReliability::noCDrating($User)  < $this->minNoCD) return substr($buf,0,-3)."</div>";
		if (libReliability::noNMRrating($User) < $this->minNoNMR) return substr($buf,0,-3)."</div>";

		// show no join button if player is blocked/tempBan
		if ($User->tempBan > time()) return substr($buf,0,-3)."</div>";

		$buf .= '<form style="display: inline;" onsubmit="return confirm(\''.$question.'\');" method="post" action="board.php?gameID='.$this->id.'">
			<input type="hidden" name="formTicket" value="'.libHTML::formTicket().'" />';
			
		if( $this->phase == 'Pre-game'&& count($this->Members->ByCountryID)>0 )
		{
			$buf .= '<label>Join for</label> <em>'.$this->minimumBet.libHTML::points().'</em> as: <select name="countryID">';
			foreach($this->Variant->countries as $id=>$name)
				if (!isset($this->Members->ByCountryID[($id +1)]))
					$buf .= '<option value="'.($id +1).'" />'.$name.'</option>';
			$buf .= '</select>';
		}
		elseif( $this->phase == 'Pre-game' )
		{
			if ( $this->pot > 0 )
				$buf .= 'Bet to join: <em>'.$this->minimumBet.libHTML::points().'</em>: ';
		}
		else
		{
			$buf .= $this->Members->selectCivilDisorder();
		}

		if ( $this->private )
			$buf .= '<br />'.self::passwordBox();

		$buf .= ' <input type="submit" name="join" value="'.l_t('Join').'" class="form-submit" />';

		$buf .= '</form></div>';
		return $buf;
	}

	/**
	 * A bar with a button letting people view the game
	 * @return string
	 */
	function openBar()
	{
		global $User;

/*		I've put the following code in remarks to isplay the view Button, even if it's the PreGame-Phase 
		(to view the chat for example).
		if( !$this->Members->isJoined() && $this->phase == 'Pre-game' )
			return '';
*/
		return '<a href="board.php?gameID='.$this->id.'#gamePanel">'.
			l_t($this->Members->isJoined()?'Open':'View').'</a>';

		return '<form method="get" action="board.php#gamePanel"><div>
			<input type="hidden" name="gameID" value="'.$this->id.'" />
			<input type="submit" value="" class="form-submit" />
			</div></form>';
	}
	
	/**
	 * A bar with a button letting people view the game
	 * @return string
	 */
	public function description()
	{
		if ($this->description == "" && $this->directorUserID == 0) return;
	
		global $User;
		
		$buf = '<div class="bar titleBar" '.($this instanceof panelGameBoard ? '' : 'style="background-color:#FAFAFA"').'>';
		
		if ($this->directorUserID != 0)
		{
			$director = new User($this->directorUserID);
			$buf .= 'This is a moderated game. Gamedirector: '.$director->profile_link();
			if (isset($this->Members->ByUserID[$this->directorUserID]))
				$buf .= ' (is playing too)';
			$buf .= '.';
		}

		if ($this->description != "")
		{
			if ($this->isJoinable() || $this->phase == 'Pre-game' || !$this->Members->isJoined() )
			{
				$buf .= '<div class="hr"></div>'.$this->description.'</span>';
			}
			else
			{
				$buf .= '<span id="DescriptionButton">
							<a href="#" onclick="$(\'Description\').show(); $(\'DescriptionButton\').hide(); return false;">
								<br>Click here to view game description.
							</a>
						</span>';
						
				$buf .= '<span id="Description" style="'.libHTML::$hideStyle.'">
							<div class="hr"></div>
							'.$this->description.'</span>';
			}
		}	
		$buf .= '</div><div style="font-size:5px; clear:both"><br></div>';
	
		return $buf;
	}
}


?>
