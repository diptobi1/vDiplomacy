<?php
/*
    Copyright (C) 2018 Oliver Auth

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
    along with vDiplomacy.  If not, see <http://www.gnu.org/licenses/>.
*/

defined('IN_CODE') or die('This script can not be run by itself.');

if ($edit != true)
{
	print "<b> - Only sysadmins and devs can check the development admin tool.</b></div>";
	libHTML::footer();
	exit;
}

print '<p><strong>'.l_t('Error logs:').'</strong>  (<a class="light" href="dev.php?tab=Admin&clearErrorLog">Clear</a>)</p>';

$dir =  libDevError::directory();

// Clear Logfiles if selected.
if ( isset($_REQUEST['clearErrorLog']) && $edit == true)
	foreach(glob($dir."/*.txt") as $logfile)
		unlink($logfile);
$errorlogs = libDevError::errorTimes();

$alternate = false;
print '<TABLE class="credits">';
foreach ( $errorlogs as $errorlog )
	print '<tr class="replyalternate'.(($alternate = !$alternate) ? '1' : '2' ).'">
		<td class="left time">'.libTime::text($errorlog).'</td>
		<td class="right message"><a class="light" href="dev.php?viewErrorLog='.$errorlog.'">Open</a></td>
		</tr>';
print '</TABLE>';

if ($User->id == 5)
{
	if (isset($_REQUEST['newVariantName']) && isset($_REQUEST['newVariantID']) && isset($_REQUEST['newVariantYear']))
	{
		$newID  =(int)$_REQUEST['newVariantID'];
		$newYear=(int)$_REQUEST['newVariantYear'];
		$newName=preg_replace('/[^a-zA-Z0-9]/', '', $_REQUEST['newVariantName']);

		require_once('dev/newVariantDefaults.php');
		
		mkdir('variants/'.$newName);
		mkdir('variants/'.$newName.'/cache');
		mkdir('variants/'.$newName.'/classes');
		mkdir('variants/'.$newName.'/interactiveMap');
		mkdir('variants/'.$newName.'/resources');
		
		touch ('variants/'.$newName.'/cache/.htaccess');
		file_put_contents ('variants/'.$newName.'/variant.php', $variantTxt);
		file_put_contents ('variants/'.$newName.'/install.php', $installTxt);
		file_put_contents ('variants/'.$newName.'/classes/drawMap.php', $drawMapTxt);
		file_put_contents ('variants/'.$newName.'/classes/adjudicatorPreGame.php', $adjucatorPreGameTxt);
		file_put_contents ('variants/'.$newName.'/resources/style.css', $styleTxt);
		file_put_contents ('variants/'.$newName.'/variant.php', $variantTxt);
		
		print '<div class="hr"></div>Variant <b>'.$newName.'</b> with ID:'.$newID.' created.';
	}

	print '<div class="hr"></div>
			<b>Create new variantfiles:</b><br>
			<style type="text/css"> td {white-space: nowrap;} </style>
			<form style="display: inline" method="get" name="newVariant">
				<input type="hidden" name="tab" value="Admin">
				<table>
					<tr><td style="">Name:</td> <td><input type="text" name="newVariantName" value="" size="20"></td> <td style=" width: 100%;"></td></tr>
					<tr><td>VariantID:    </td> <td><input type="text" name="newVariantID"   value="" size="20"></td> <td style=" width: 100%;"></td></tr>
					<tr><td>Starting year:</td> <td><input type="text" name="newVariantYear" value="" size="20"></td> <td style=" width: 100%;"></td></tr>
				</table>
				<b><input type="submit" class="form-submit" name="submitNewVariant" value="Create variant files" /></b>
			</form>';
}
print '<div class="hr"></div>';

?>