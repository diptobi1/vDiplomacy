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
	print "<b> - Only sysadmins and devs can check the DevErrorLog tool.</b></div>";
	libHTML::footer();
	exit;
}
	
print '<p><strong>'.l_t('Error logs:').'</strong>  (<a class="light" href="dev.php?tab=Errors&clearErrorLog">Clear</a>)</p>';

$dir =  libDevError::directory();

// Clear Logfiles if selected.
if ( isset($_REQUEST['clearErrorLog']) && $edit == true)
	foreach(glob($dir."/*.txt") as $logfile)
		unlink($logfile);

$errorlogs = libDevError::errorTimes();

$alternate = false;
print '<TABLE class="credits">';

foreach ( $errorlogs as $errorlog )
{
	$alternate = ! $alternate;

	print '<tr class="replyalternate'.($alternate ? '1' : '2' ).'">';
	print '<td class="left time">'.libTime::text($errorlog).'</td>';
	print '<td class="right message"><a class="light" href="dev.php?viewErrorLog='.$errorlog.'">Open</a></td>';
	print '</tr>';
}

print '</TABLE>';

?>