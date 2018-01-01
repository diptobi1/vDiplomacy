<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class adminActionsVDip extends adminActions
{
	public function __construct()
	{
		parent::__construct();

		$vDipActions = array(
			'changeReliability' => array(
				'name' => 'Change reliability',
				'description' => 'Enter the new phases played and missed and the new CD-count',
				'params' => array('userID'=>'User ID', 'integrityBalance'=>'Integrity Balance')
			),
			'updateCCIP' => array(
				'name' => 'Recalculate CC and IP',
				'description' => 'Recalculate the CC and IP matches for a given game.',
				'params' => array('gameID'=>'Game ID')
			),
			'potModifier' => array(
				'name' => 'Change the vDip-value of the game.',
				'description' => 'Changes the vDip-points-value of the game by dividing the vDip-points of the game with the modifier. A necative vDip-score is set to 0.',
				'params' => array('gameID'=>'Game ID', 'modifier'=>'Modifier for the point distribution')
			),
			'tempBan' => array(
				'name' => 'Temporary ban a player',
				'description' => 'How many days should the player be blocked from joining or creating new games.',
				'params' => array('userID'=>'User ID', 'ban'=>'Days')
			),
			'changeTargetSCs' => array(
				'name' => 'Change target SCs.',
				'description' => 'Enter the new CD count needed for the win.',
				'params' => array('gameID'=>'Game ID', 'targetSCs'=>'New target SCs')
			),
			'changeMaxTurns' => array(
				'name' => 'Set a new EoG turn',
				'description' => 'Enter the new turn that ends the game.',
				'params' => array('gameID'=>'Game ID', 'maxTurns'=>'New Max Turns')
			),
			'changeGameReq' => array(
				'name' => 'Change the game requirements.',
				'description' => 'Enter the min. Rating / min. phases played and the max. games left needed to join this game.',
				'params' => array('gameID'=>'Game ID', 'minRating'=>'Min. Rating','minPhases'=>'Min. Phases played')
			),
			'extendPhase' => array(
				'name' => 'Extend the curent phase',
				'description' => 'How many days should the curent phase extend?',
				'params' => array('gameID'=>'Game ID', 'extend'=>'Days to extend')
			),
			'toggleAdminLock' => array(
				'name' => 'Lock/unlock a game.',
				'description' => 'Lock (or unlock) a game to prevent users to enter orders.',
				'params' => array('gameID'=>'GameID')
			),
			'replaceCoutries' => array(
				'name' => 'Replace country-player.',
				'description' => 'Replace one player in a given game with another one.',
				'params' => array('userID'=>'UserID to be replaced','replaceID'=>'UserID replacing','gameIDs'=>'GameID (all active if empty)', )
			),
			'disableVotes' => array(
				'name' => 'Disable some or all vote buttons',
				'description' => 'Disable or enable some or all vote-buttons.<br />
				If you want enable all vote buttons again use "none"',
				'params' => array('votes'=>'Comma separated list of votes you want disabled'),
			),			
			'ChangeDirectorLicense' => array(
				'name' => 'Change director license',
				'description' => 'Manually grand or remove the license to create moderated games.',
				'params' => array('userID'=>'User ID','newLicense'=>'change license to (Yes, No or NULL)'),
			),
			'ChangeCDNMR' => array(
				'name' => 'Change CDs and NMRs',
				'description' => 'Change the CDs or NMRs in a given game or from a user. If you only enter a UserID or a GameID you get a list of all CDs and NMRs of this user or in this game.',
				'params' => array('MyUserID'=>'User ID', 'MyGameID'=>'GameID', 'TurnID'=>'Turn', 'CDorNMR'=>'What to change'),
			),
			
		);
		
		adminActions::$actions = array_merge(adminActions::$actions, $vDipActions);
	}

	public function changeReliability(array $params)
	{
		global $DB;
		
		$userID = (int)$params['userID'];
		$integrityBalance = (int)$params['integrityBalance'];

		list($integrityBalanceOld) = $DB->sql_row("SELECT integrityBalance FROM wD_Users WHERE id=".$userID);

		$DB->sql_put("UPDATE wD_Users SET integrityBalance = ".$integrityBalance." WHERE id=".$userID);

		return 'This users integrityBalance got changed from <b>'.$integrityBalanceOld.'</b> to <b>'.$integrityBalance.'</b>.';
	}
	
	public function changeReliabilityConfirm(array $params)
	{
		global $DB;
		
		$userID = (int)$params['userID'];
		$integrityBalance = (int)$params['integrityBalance'];
		
		list($integrityBalanceOld) = $DB->sql_row("SELECT integrityBalance FROM wD_Users WHERE id=".$userID);

		return 'This users integrityBalance will be changed from <b>'.$integrityBalanceOld.'</b> to <b>'.$integrityBalance.'</b>.';
	}
	
	public function updateCCIP(array $params)
	{
		global $DB;
		
		$gameID = (int)$params['gameID'];
		
		$Variant=libVariant::loadFromGameID($gameID);
		$Game = $Variant->Game($gameID);

		$Game->Members->updateCCIP();
		
		return 'Matches recalculated.';
	}
	
	public function tempBan(array $params)
	{
		global $DB;
		
		$userID = (int)$params['userID'];
		$days   = (int)$params['ban'];

		$DB->sql_put("UPDATE wD_Users SET tempBan = ". ( time() + ($days * 86400) )." WHERE id=".$userID);

		if ($days == 0)
			return 'This user is now unblocked and can join and create games again.';
			
		return 'This user is now blocked from joining and creating games for <b>'.$days.'</b> days.';
	}
	
	public function changeTargetSCs(array $params)
	{
		global $DB;

		$gameID   = (int)$params['gameID'];
		$targetSCs= (int)$params['targetSCs'];
		
		$DB->sql_put("UPDATE wD_Games SET targetSCs = ".$targetSCs." WHERE id=".$gameID);

		return 'The target SCs for the game was changed to: '.$targetSCs;
	}
	public function changeMaxTurns(array $params)
	{
		global $DB;

		$gameID   = (int)$params['gameID'];
		$maxTurns= (int)$params['maxTurns'];
		
		$DB->sql_put("UPDATE wD_Games SET maxTurns = ".$maxTurns." WHERE id=".$gameID);

		return 'The max. turns for the game was changed to: '.$targetSCs;
	}
	public function extendPhase(array $params)
	{
		global $DB;

		$gameID = (int)$params['gameID'];
		$extend = (int)$params['extend'];
		
		$DB->sql_put("UPDATE wD_Games
			SET processTime = processTime + ". $extend * 86400 ."
			WHERE id = ".$gameID);
			
		return 'The target curend phase for the game was extended by '.$extend.' day(s).';
	}
	
	public function changeGameReq(array $params)
	{
		global $DB;

		$gameID    = (int)$params['gameID'];
		$minRating = (int)$params['minRating'];
		$minPhases = (int)$params['minPhases'];
		
		$DB->sql_put("UPDATE wD_Games SET minimumReliabilityRating = ".$minRating.", minPhases = ".$minPhases." WHERE id=".$gameID);

		return 'This games reliability requirements was changed to: minimumReliabilityRating = '.$minRating.', minPhases = '.$minPhases;
	}
	
	public function toggleAdminLock(array $params)
	{
		global $DB;
		$gameID = (int)$params['gameID'];
		list($status)=$DB->sql_row("SELECT adminLock FROM wD_Games WHERE id = ".$gameID);
		$DB->sql_put("UPDATE wD_Games SET adminLock = '".($status == 'Yes' ? 'No' : 'Yes')."' WHERE id = ".$gameID);		
		
		return 'This game is now '.( $status == 'No' ? 'locked' : 'unlocked').'.';
	}

	public function replaceCoutries(array $params)
	{
		global $DB;
		
		$gameIDs   = (int)$params['gameIDs'];
		$userID    = (int)$params['userID'];
		$replaceID = (int)$params['replaceID'];

		$games = array();

		$tabl = $DB->sql_tabl(
			'SELECT gameID FROM wD_Members
				WHERE status = "Playing" AND userID = "'.$userID.'"'.($gameIDs != 0 ? ' AND gameID = "'.$gameIDs.'"':'') );
		while(list($gameID) = $DB->tabl_row($tabl))
			$games[] = $gameID;
		
		// Load the two users as Userobjects.
		try
		{
			$SendToUser = new User($replaceID);
		}
		catch (Exception $e)
		{
			$error = l_t("Invalid user ID given.");
		}
		
		try
		{
			$SendFromUser = new User($userID);
		}
		catch (Exception $e)
		{
			$error = l_t("Invalid user ID given.");
		}

		$ret = '';
		
		foreach ($games AS $gameID)
		{
			$Variant=libVariant::loadFromGameID($gameID);
			$Game = $Variant->Game($gameID);
		
			list($blocked) = $DB->sql_row("SELECT count(*) FROM wD_Members AS m
											LEFT JOIN wD_BlockUser AS f ON ( m.userID = f.userID )
											LEFT JOIN wD_BlockUser AS t ON ( m.userID = t.blockUserID )
										WHERE m.gameID = ".$Game->id." AND (f.blockUserID =".$SendToUser->id." OR t.userID =".$SendToUser->id.")");

			// Check for additional requirements:
			require_once(l_r('lib/reliability.php'));		 
			if ( $Game->minimumReliabilityRating > $SendToUser->reliabilityRating )
				$ret .= '<b>Error:</b> The reliability of '.$SendToUser->username.' is not high enough to join the game <a href="board.php?gameID='.$Game->id.'">'.$Game->name.'</a>.<br>';
			elseif ( array_key_exists ( $SendToUser->id , $Game->Members->ByUserID))
				$ret .= '<b>Error:</b> '.$SendToUser->username.' is already a member of the game <a href="board.php?gameID='.$Game->id.'">'.$Game->name.'</a>.<br>';
			elseif ($blocked > 0)
				$ret.= '<b>Error:</b> '.$SendToUser->username.' is blocked by someone in game <a href="board.php?gameID='.$Game->id.'">'.$Game->name.'</a>.<br>';
			else
			{
				list($bet) = $DB->sql_row("SELECT bet FROM wD_Members WHERE userID=".$userID." AND gameID=".$gameID);
				$newPoints = $SendToUser->points - $bet;
				if ($newPoints < 0) $newPoints = 0;

				$DB->sql_put("UPDATE wD_Users SET points = ".$newPoints." WHERE id=".$SendToUser->id);
				$DB->sql_put("UPDATE wD_Users SET points = ".($SendFromUser->points + $bet)." WHERE id=".$SendFromUser->id);
				$DB->sql_put("UPDATE wD_Members SET userID = ".$SendToUser->id." WHERE userID=".$SendFromUser->id." AND gameID=".$Game->id);
				$ret.= 'In game <a href="board.php?gameID='.$Game->id.'">'.$Game->name.'</a> the user '.$SendFromUser->username.' was removed and replaced by '.$SendToUser->username.'.<br>';
			}
		}
		return $ret;
	}
	public function replaceCoutriesConfirm(array $params)
	{
		global $DB;
		
		$userID    = (int)$params['userID'];
		$replaceID = (int)$params['replaceID'];
		$gameIDs   = (int)$params['gameIDs'];
		
		list($userName)    = $DB->sql_row("SELECT username FROM wD_Users WHERE id=".$userID);
		list($replaceName) = $DB->sql_row("SELECT username FROM wD_Users WHERE id=".$replaceID);
		
		if ($gameIDs == 0)
			return 'The user '.$userName.' will be removed and replaced by '.$replaceName.' in all his active games.';

		list($gameName) = $DB->sql_row("SELECT name FROM wD_Games WHERE id=".$gameIDs);
		return 'In game '.$gameName.' (id='.$gameIDs.') the user '.$userName.' will be removed and replaced by '.$replaceName.'.';
	}
	
	public function disableVotes(array $params)
	{
		global $DB;

		$gameID = intval($this->fixedGameID);

		$Variant=libVariant::loadFromGameID($gameID);
		$Game = $Variant->Game($gameID);
		$votes=strtoupper($params['votes']);

		if (strpos($votes,'NONE')!== false)
			$changeVotes='';
		else
		{
			$changeVotesArr=array();
			if (strpos($votes,'DRAW')!== false)
				$changeVotesArr[]="Draw";
			if (strpos($votes,'PAUSE')!== false)
				$changeVotesArr[]="Pause";
			if (strpos($votes,'CANCEL')!== false)
				$changeVotesArr[]="Cancel";
			if (strpos($votes,'EXTEND')!== false)
				$changeVotesArr[]="Extend";
			if (strpos($votes,'CONCEDE')!== false)
				$changeVotesArr[]="Concede";

			$changeVotes= implode ( ',' , $changeVotesArr );
			foreach ($changeVotesArr as $removeVote)
			{
				foreach ($Game->Members->ByID as $Member)
				{
					if(in_array($removeVote, $Member->votes))
					{
						unset($Member->votes[array_search($removeVote, $Member->votes)]);
						$DB->sql_put("UPDATE wD_Members SET votes='".implode(',',$Member->votes)."' WHERE id=".$Member->id);
					}
				}
			}
		}
		
		$DB->sql_put(
			"UPDATE wD_Games
			SET blockVotes = '".$changeVotes."'
			WHERE id = ".$Game->id
		);

		if ($changeVotes == '')
			$changeVotes = 'None';
		
		return l_t('Disabled votes successfully set to %s.',$changeVotes);
	}	
	
	public function ChangeDirectorLicense(array $params)
	{
		global $DB;

		$userID = (int)$params['userID'];
		$params['newLicense'] = strtoupper(substr($params['newLicense'],0,1));
		switch($params['newLicense']) {
			case 'Y':
				$newLicense = 'Yes';
				break;
			case 'N':
				$newLicense = 'No';
				break;
			default:
				$newLicense = 'NULL';
		}
	
		$DB->sql_put("UPDATE wD_Users SET directorLicense = '".$newLicense."' WHERE id=".$userID);

		return l_t('This users director license was set to %s.',$newLicense);
	}
	
	public function ChangeCDNMR(array $params)
	{
		global $DB;
		$MyUserID = (int)$params['MyUserID'];
		$MyGameID = (int)$params['MyGameID'];
		$TurnID   = strtoupper($params['TurnID']);
		$CDorNMR  = strtoupper($params['CDorNMR']);
		
		if ($MyUserID==0 && $MyGameID==0) return l_t('Need a userID or a gameID');

		if ($MyUserID!=0 && $MyGameID==0) $SQLchange = "userID = ".$MyUserID;
		if ($MyUserID==0 && $MyGameID!=0) $SQLchange = "gameID = ".$MyGameID;
		if ($MyUserID!=0 && $MyGameID!=0) $SQLchange = "userID = ".$MyUserID." AND gameID = ".$MyGameID;

		if ($TurnID == '') $TurnID = 'ALL';
		if ($TurnID != 'ALL')
			$SQLchange .= " AND turn = ".(int)$TurnID;
		
		if ( (strpos($CDorNMR,'CD')!== false) || (strpos($CDorNMR,'ALL')!== false))
			$DB->sql_put("UPDATE wD_CivilDisorders SET forcedByMod = !forcedByMod WHERE ". $SQLchange);

		if ((strpos($CDorNMR,'NMR')!== false) || (strpos($CDorNMR,'ALL')!== false))
			$DB->sql_put("UPDATE wD_NMRs SET ignoreNMR = !ignoreNMR WHERE ". $SQLchange);
		
		if ($MyUserID != 0) $checkList[] = "userID";
		if ($MyGameID != 0) $checkList[] = "gameID";
		
		$info=''; $affectedUsers = array();

		foreach ($checkList as $check)
		{
			if ($check == "userID") {
				$SQL = "userID = ".$MyUserID;
				$info .= '<li><strong>'.l_t('UserID ').' '.$MyUserID.':</strong></li>';
			} else {
				$SQL = "gameID = ".$MyGameID;
				$info .= '<li><strong>'.l_t('GameID ').' '.$MyGameID.':</strong></li>';
			}
			
			$tabl = $DB->sql_tabl("SELECT c.userID, g.name, c.countryID, c.turn, c.bet, c.SCCount, c.gameId, c.forcedByMod
				FROM wD_CivilDisorders c LEFT JOIN wD_Games g ON ( c.gameID = g.id )
				WHERE ". $SQL);
			
			while(list($userID, $name, $countryID, $turn, $bet, $SCCount, $gameID, $forcedByMod)=$DB->tabl_row($tabl))
			{
				$affectedUsers[]=$userID;
				if ($forcedByMod == 1) $info .= '<s>';
				$info .= '<li><strong>CD</strong>, 
					'.($check == "gameID" ? l_t('UserID:')." <strong>".$userID : l_t('GameID:')." <strong>".$gameID) .'</strong>,
					'.l_t('country #:').' <strong>'.$countryID.'</strong>,
					'.l_t('turn:').' <strong>'.$turn.'</strong>,
					'.l_t('bet:').' <strong>'.$bet.'</strong>,
					'.l_t('supply centers:').' <strong>'.$SCCount.'</strong>
					</li>';
				if ($forcedByMod == 1) $info .= '</s>';
			}
			
			$tabl = $DB->sql_tabl("SELECT n.userID, n.gameID, n.countryID, n.turn, n.bet, n.SCCount, g.name, n.ignoreNMR 
				FROM wD_NMRs n LEFT JOIN wD_Games g ON ( n.gameID = g.id )
				WHERE g.id != 0 AND ".$SQL);
				
			while(list($userID, $gameID, $countryID, $turn, $bet, $SCCount, $name, $ignoreNMR)=$DB->tabl_row($tabl))
			{                                          
				$affectedUsers[]=$userID;
				if ($ignoreNMR == 1) $info .= '<s>';
				$info .= '<li><strong>NMR</strong>, 
					'.($check == "gameID" ? l_t('UserID:')." <strong>".$userID : l_t('GameID:')." <strong>".$gameID) .'</strong>,
					'.l_t('country #:').' <strong>'.$countryID.'</strong>,
					'.l_t('turn:').' <strong>'.$turn.'</strong>,
					'.l_t('bet:').' <strong>'.$bet.'</strong>,
					'.l_t('supply centers:').' <strong>'.$SCCount.'</strong>
					</li>';				
				if ($ignoreNMR == 1) $info .= '</s>';
			}
			$info .= '<br>';
		}
		
		$affectedUsers = array_unique($affectedUsers);
		
		$DB->sql_put("UPDATE wD_Users u 
			SET u.cdCount = (SELECT COUNT(1) FROM wD_CivilDisorders c WHERE c.userID = u.id AND c.forcedByMod=0),
				u.nmrCount = (SELECT COUNT(1) FROM wD_NMRs n WHERE n.userID = u.id AND n.ignoreNMR=0),
				u.reliabilityRating = (POW( (
					(100 * ( 1.0 - ((cast(u.cdCount as signed) + u.deletedCDs) / (u.gameCount+1)) ))
				    +  (100 * (1.0 -   ((u.nmrCount)/(u.phaseCount+1))))
			    )/2 , 3)/10000)
			WHERE u.id IN (".implode(',',$affectedUsers).")");
			
		return $info;
	
	}
	
	public function potModifier(array $params)
	{
		global $DB;
		$gameID   = (int)$params['gameID'];
		$modifier = (int)$params['modifier'];

		list($gamePhase)=$DB->sql_row("SELECT phase FROM wD_Games WHERE id = ".$gameID);
		if ($gamePhase == 'Finished')
			return "Can't set modifier on finished game.";
		
		if ($modifier < 1 || $modifier > 10)
			return 'Unreasonable modifier. No changes made...';
			
		list($old_modifier)=$DB->sql_row("SELECT potModifier FROM wD_Games WHERE id = ".$gameID);
		$DB->sql_put("UPDATE wD_Games SET potModifier = '".$modifier."' WHERE id = ".$gameID);		
		
		return 'This game vDip-modifier changed from '.$old_modifier.' to '.$modifier.'.';
	
	}	
	
}
?>
