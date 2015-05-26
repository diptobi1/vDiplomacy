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

/**
 * @package Board
 */

require_once('header.php');

// If viewing an archive page make that the title, otherwise us the default
libHTML::starthtml(isset($_REQUEST['viewArchive'])?$_REQUEST['viewArchive']:false);

if ( ! isset($_REQUEST['gameID']) )
{
	libHTML::error(l_t("You haven't specified a game to view, please go back to the game listings and choose one."));
}

$gameID = (int)$_REQUEST['gameID'];

// If we are trying to join the game lock it for update, so it won't get changed while we are joining it.
if ( $User->type['User'] && ( isset($_REQUEST['join']) || isset($_REQUEST['leave']) ) && libHTML::checkTicket() )
{

	try
	{
		require_once(l_r('gamemaster/game.php'));

		$Variant=libVariant::loadFromGameID($gameID);
		libVariant::setGlobals($Variant);
		$Game = $Variant->processGame($gameID);
		
		if ( isset($_REQUEST['join']) )
		{
			// They will be stopped here if they're not allowed.
			$Game->Members->join(
				( isset($_REQUEST['gamepass']) ? $_REQUEST['gamepass'] : null ),
				( isset($_REQUEST['countryID']) ? $_REQUEST['countryID'] : null ) );
		}
		elseif ( isset($_REQUEST['leave']) )
		{
			$reason=$Game->Members->cantLeaveReason();

			if($reason)
				throw new Exception(l_t("Can't leave game; %s.",$reason));
			else
				$Game->Members->ByUserID[$User->id]->leave();
		}
	}
	catch(Exception $e)
	{
		// Couldn't leave/join game
		libHTML::error($e->getMessage());
	}
}
else
{
	try
	{
		require_once(l_r('objects/game.php'));
		require_once(l_r('board/chatbox.php'));
		require_once(l_r('gamepanel/gameboard.php'));

		$Variant=libVariant::loadFromGameID($gameID);
		libVariant::setGlobals($Variant);
		$Game = $Variant->panelGameBoard($gameID);

		// In an game with strict rlPolicy don't allow users to join from a Left if they know someone else in this game
		// Usually after a Mod set them to CD.
		if ( $Game->Members->isJoined() && $Game->rlPolicy == 'Strict' && $User->rlGroup < 0 && $Game->Members->ByUserID[$User->id]->status == 'Left')
		{
			require_once ("lib/relations.php");			
			if ($message = libRelations::checkRelationsGame($User, $Game))
				print "<b>Notice:</b> ".$message;
				unset($Game->Members->ByUserID[$User->id]);
		}
		
		if ( $Game->Members->isJoined() )
		{
		
			// We are a member, load the extra code that we might need
			require_once(l_r('gamemaster/gamemaster.php'));
			require_once(l_r('board/member.php'));
			require_once(l_r('board/orders/orderinterface.php'));

			global $Member;
			$Game->Members->makeUserMember($User->id);
			$Member = $Game->Members->ByUserID[$User->id];
			
			// Advanced-Log
			$DB->sql_put("INSERT INTO wD_AccessLogAdvanced SET
							userID   = ".$User->id.",
							request  = CURRENT_TIMESTAMP,
							ip       = INET_ATON('".$_SERVER['REMOTE_ADDR']."'),
							action   = 'Board',
							memberID = '".$Member->id."'"
							);
			
		}
	}
	catch(Exception $e)
	{
		// Couldn't load game
		libHTML::error(l_t("Couldn't load specified game; this probably means this game was cancelled or abandoned.")." ".
			($User->type['User'] ? l_t("Check your <a href='index.php' class='light'>notices</a> for messages regarding this game."):''));
	}
}

if ( isset($_REQUEST['viewArchive']) )
{
	// Start HTML with board gamepanel header
	//print '</div>';
	print '<div class="content-bare content-board-header">';
	print '<div class="boardHeader">'.$Game->contentHeader().'</div>';
	print '</div>';
	print '<div class="content content-follow-on">';

	print '<p><a href="board.php?gameID='.$Game->id.'" class="light">'.l_t('&lt; Return').'</a></p>';

	switch($_REQUEST['viewArchive'])
	{
		case 'Orders': require_once(l_r('board/info/orders.php')); break;
		case 'Messages': require_once(l_r('board/info/messages.php')); break;
		case 'Graph': require_once(l_r('board/info/graph.php')); break;
		case 'Maps': require_once(l_r('board/info/maps.php')); break;
		case 'Reports':
			require_once(l_r('lib/modnotes.php'));
			libModNotes::checkDeleteNote();
			libModNotes::checkInsertNote();
			print libModNotes::reportBoxHTML('Game',$Game->id);
			print libModNotes::reportsDisplay('Game', $Game->id);
			break;
		default: libHTML::error(l_t("Invalid info parameter given."));
	}

	print '</div>';
	libHTML::footer();
}

// Before HTML pre-generate everything and check input, so game summary header will be accurate

if( ( (isset($Member) && $Member->status == 'Playing') || $User->id == $Game->directorUserID) && $Game->phase!='Finished' )
{
	if( $Game->phase != 'Pre-game' )
	{
		if(isset($_REQUEST['Unpause'])) $_REQUEST['Pause']='on'; // Hack because Unpause = toggle Pause
		
		foreach(Members::$votes as $possibleVoteType) {
			if( isset($_REQUEST[$possibleVoteType]) && isset($Member) && libHTML::checkTicket() )
				$Member->toggleVote($possibleVoteType);
		}
	}

	$DB->sql_put("COMMIT");

	if( $Game->processStatus!='Crashed' && $Game->processStatus!='Paused' && $Game->attempts > count($Game->Members->ByID)/2+4  )
	{
		require_once(l_r('gamemaster/game.php'));
		$Game = $Game->Variant->processGame($Game->id);
		$Game->crashed();
		$DB->sql_put("COMMIT");
	}
	else
	{
		if( isset($Member) && $Game->Members->votesPassed() && $Game->phase!='Finished' )
		{
			$DB->sql_put("UPDATE wD_Games SET attempts=attempts+1 WHERE id=".$Game->id);
			$DB->sql_put("COMMIT");

			require_once(l_r('gamemaster/game.php'));
			$Game = $Game->Variant->processGame($Game->id);
			try
			{
				$Game->applyVotes(); // Will requery votesPassed()
				$DB->sql_put("UPDATE wD_Games SET attempts=0 WHERE id=".$Game->id);
				$DB->sql_put("COMMIT");
			}
			catch(Exception $e)
			{
				if( $e->getMessage() == "Abandoned" || $e->getMessage() == "Cancelled" )
				{
					assert('$Game->phase=="Pre-game" || $e->getMessage() == "Cancelled"');
					$DB->sql_put("COMMIT");
					libHTML::notice(l_t('Cancelled'), l_t("Game was cancelled or didn't have enough players to start."));
				}
				else
					$DB->sql_put("ROLLBACK");

				throw $e;
			}
		}
		else if( $Game->needsProcess() )
		{
			$DB->sql_put("UPDATE wD_Games SET attempts=attempts+1 WHERE id=".$Game->id);
			$DB->sql_put("COMMIT");

			require_once(l_r('gamemaster/game.php'));
			$Game = $Game->Variant->processGame($Game->id);
			if( $Game->needsProcess() )
			{
				try
				{
					$Game->process();
					$DB->sql_put("UPDATE wD_Games SET attempts=0 WHERE id=".$Game->id);
					$DB->sql_put("COMMIT");
				}
				catch(Exception $e)
				{
					if( $e->getMessage() == "Abandoned" || $e->getMessage() == "Cancelled" )
					{
						assert('$Game->phase=="Pre-game" || $e->getMessage() == "Cancelled"');
						$DB->sql_put("COMMIT");
						libHTML::notice(l_t('Cancelled'), l_t("Game was cancelled or didn't have enough players to start."));
					}
					else
						$DB->sql_put("ROLLBACK");

					throw $e;
				}
			}
		}
	}

	/* This is a bit ugly. BEcause of the countrySwitch-code it might be possible that a Member
	 * is no longer in the game, once it's processed.
	 * Skip the next few lines if so.
	 */
	if (!(isset($Game->Members->ByUserID[$User->id])) && isset($Member))
	{
		unset($Member);
		goto NoMoreMember;
	}
	
	if( $Game instanceof processGame )
	{
		$Game = $Game->Variant->panelGameBoard($Game->id);
		$Game->Members->makeUserMember($User->id);
		$Member = $Game->Members->ByUserID[$User->id];
	}

	if ( 'Pre-game' != $Game->phase && $Game->phase!='Finished' && isset($Member))
	{
		if ($Game->adminLock == 'No' || $User->type['Admin'] || defined('AdminUserSwitch'))
		{
			$OI = OrderInterface::newBoard();
			$OI->load();

			$Orders = '<div id="orderDiv'.$Member->id.'">'.$OI->html().'</div>';
			unset($OI);
		}
		else
		{
			$Orders = '<div align="center" id="orderDiv'.$Member->id.'">Game is currently locked by an admin (usually to fix some errors).</div>';
		}
	}
}

// Skip-target for the CountrySwitch-exit.
NoMoreMember:

if ( 'Pre-game' != $Game->phase && ( isset($Member) || $User->type['Moderator'] || $User->id == $Game->directorUserID ) )
{
	$CB = $Game->Variant->Chatbox();

	// Now that we have retrieved the latest messages we can update the time we last viewed the messages
	// Post messages we sent, and get the user we're speaking to
	$msgCountryID = $CB->findTab();

	$CB->postMessage($msgCountryID);
	$DB->sql_put("COMMIT");

	$forum = $CB->output($msgCountryID);

	unset($CB);

	libHTML::$footerScript[] = 'makeFormsSafe();';
}

/*
 * Display the chatbox in gunboat games if there are unread system messages
 */
if ( isset($Member) && count($Member->newMessagesFrom) > 0 && $Game->pressType=='NoPress')
{
	$CB = $Game->Variant->Chatbox();
	$forum = $CB->output(0);
	$Member->seen(0);
	unset($CB);
}


/*
 * Pregame-chat hack
 */

if ($Game->phase == 'Pre-game')
{	

	$CB = $Game->Variant->Chatbox();

	if( isset($_REQUEST['newmessage']) AND $_REQUEST['newmessage']!="")
	{
		$_REQUEST['newmessage'] = "(".$User->username."): ".$_REQUEST['newmessage'];
		$CB->postMessage(0);
		$DB->sql_put("COMMIT");
	}
	
	$forum = $CB->output(0);
	unset($CB);

	if (isset($Member))
		$Member->seen(0);

	libHTML::$footerScript[] = 'makeFormsSafe();';
}	
// END PREGAME-CHAT

$map = $Game->mapHTML();

/*if( isset($_REQUEST['goNow']) )
{
	$DB->sql_put("UPDATE wD_Games SET processTime=1 WHERE id=".$Game->id);
}//*/
/*require_once(l_r('gamemaster/game.php'));
$Game = $Variant->processGame($Game->id);
$tabl=$DB->sql_tabl("SELECT id FROM wD_Users WHERE points>150 LIMIT 4");
while(list($id)=$DB->tabl_row($tabl))
	processMember::create($id, 5);

$Game = $Game->Variant->panelGameBoard($Game->id);//*/

/*
 * Now there is $orders, $form, and $map. That's all the HTML cached, now begin printing
 */

//print '</div>';

if (isset(Config::$hiddenVariants) && in_array($Game->Variant->id,Config::$hiddenVariants) && $User->type['Guest'])
{
	print '</div>';
	libHTML::footer();
	exit;
}

print '<div class="content-bare content-board-header">';
print '<div class="boardHeader">'.$Game->contentHeader().'</div>';
print '</div>';
print '<div class="content content-follow-on variant'.$Game->Variant->name.'">';

// Now print the forum, map, orders, and summary
if ( isset($forum) )
{
	print $forum.'<div class="hr"></div>';
}

/*
 * Easy way to make the map independent from the page-layout. May be activated later.
 *
print '</div>';
print '<span>'.$map.'</span>';
print '<div style="padding: 0px !important;" class="content content-follow-on variant'.$Game->Variant->name.'"><div class="hr"></div>';
*/
print $map.'<div class="hr"></div>';

if (isset($Orders))
{
	print $Orders.'<div class="hr"></div>';
}

print $Game->summary(true);

if($User->type['Moderator'])
{
	$modActions=array();

	if($Game->gameOver=='No')
	{
		$modActions[] = libHTML::admincpType('Game',$Game->id);

		$modActions[] = libHTML::admincp('drawGame',array('gameID'=>$Game->id), l_t('Draw game'));
		$modActions[] = libHTML::admincp('togglePause',array('gameID'=>$Game->id), l_t('Toggle pause'));
		if($Game->processStatus=='Not-processing')
		{
			$modActions[] = libHTML::admincp('setProcessTimeToNow',array('gameID'=>$Game->id), l_t('Process now'));
			$modActions[] = libHTML::admincp('setProcessTimeToPhase',array('gameID'=>$Game->id), l_t('Process one phase length from now'));
		}
		$modActions[] = libHTML::admincp('updateCCIP',array('gameID'=>$Game->id), l_t('Recalculate IP and CC matches'));

		if($User->type['Admin'])
		{
			if($Game->processStatus == 'Crashed')
				$modActions[] = libHTML::admincp('unCrashGames',array('excludeGameIDs'=>''), l_t('Un-crash all crashed games'));

			$modActions[] = libHTML::admincp('reprocessGame',array('gameID'=>$Game->id), l_t('Reprocess game'));
			$modActions[] = libHTML::admincp('allReady',array('gameID'=>$Game->id), 'Set Ready');
		}

		if( $Game->phase!='Pre-game' && !$Game->isMemberInfoHidden() )
		{
			$userIDs=implode('%2C',array_keys($Game->Members->ByUserID));
			$modActions[] = '<br />'.l_t('Multi-check:');
			foreach($Game->Members->ByCountryID as $countryID=>$Member)
			{
				$modActions[] = '<a href="admincp.php?tab=Multi-accounts&aUserID='.$Member->userID.'&bUserIDs='.$userIDs.'" class="light">'.
					$Member->memberCountryName().'</a>';
			}
		}
	}

	if($modActions)
	{
		print '<div class="hr"></div>';
		print '<p class="notice">';
		print implode(' - ', $modActions);
		print '</p>';
		print '<div class="hr"></div>';
	}
}

// TODO: Have this loaded up when the game object is loaded up
list($directorUserID) = $DB->sql_row("SELECT directorUserID FROM wD_Games WHERE id = ".$Game->id);
if( isset($directorUserID) && $directorUserID == $User->id)
{
	// This guy is the game director
	define("INBOARD", true);
	
	require_once(l_r("admin/adminActionsForms.php"));
}

print '</div>';

libHTML::footer();

?>
