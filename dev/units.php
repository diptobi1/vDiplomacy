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

/*
 * Show the variant-information with some edit possibilities for variant developers
 */

// Get the variant-units and possible terriDs in an array:
if ($variantID != 0)
{
	$terrNameByID = array();
	$tabl = $DB->sql_tabl("SELECT id, name FROM wD_Territories WHERE mapID=".$Variant->mapID);
	while(list($id, $name) = $DB->tabl_row($tabl))
		$terrNameByID[$id]=$name;
	asort($terrNameByID);
}

if ( ($edit == true) && (isset($_REQUEST['action'])) && ($variantID != 0) )
{
	copy('variants/'.Config::$variants[$variantID].'/classes/adjudicatorPreGame.php', 'variants/'.Config::$variants[$variantID].'/cache/'.date("ymd-His").'-units-adjudicatorPreGame.php');

	$countryID = (int)$_REQUEST['countryID'];
	$countryName = $Variant->countries[$countryID];
	$unitType = (isset($_REQUEST['unitType']) ? ($_REQUEST['unitType'] != 'Army' ? 'Fleet' : 'Army') : 'Army');
	
	$oldUnitsArray = (isset($_REQUEST['oldUnits']) ? $_REQUEST['oldUnits'] : array());
	switch ($_REQUEST['action'])
	{
		case 'deleteUnit':
			unset ($oldUnitsArray[$_REQUEST['TerrName']]);
			break;
		case 'addUnit':
			$oldUnitsArray[$_REQUEST['TerrName']] = 'Army';
			break;
		case 'changeUnit':
			$oldUnitsArray[$_REQUEST['TerrName']] = $unitType;
			break;
	}
	
	$newUnits = "\t\t'".$countryName."' => array(";
	foreach ($oldUnitsArray as $terrName => $unitType)
	{
		if (in_array($terrName, $terrNameByID))
			$newUnits .= "'".$terrName."' => '".$unitType."',";
	}
	$newUnits = rtrim($newUnits,',').'),';

	$found = 0;
	$handle = fopen('variants/'.Config::$variants[$variantID].'/classes/adjudicatorPreGame.php', 'r');
	while (!(feof($handle)))
	{
		$line = rtrim(fgets($handle));
		
		if (strpos($line,'protected $countryUnits = array(') > 0 && $found == 0)
			$found = 1;

		if (strpos($line,$countryName) > 0 && $found == 1)
		{
			$newAdjudicatorPreGame[]=$newUnits;
			$found = 2;
		}
		else
		{
			$newAdjudicatorPreGame[]=$line;
		}
	}
	fclose($handle);

	file_put_contents('variants/'.Config::$variants[$variantID].'/classes/adjudicatorPreGame.php', implode($newAdjudicatorPreGame,"\n"));	
}

print '<b>Variant: '.$selectVariantForm.'</b>
        <style type="text/css"> td { padding:2px; font-weight: bold; white-space: nowrap;} </style>';

if ($variantID != 0)
{
	// Fake to copy the protected countryUnits in a public startingUnits variable...
	class adjudicatorPreGame
	{
		public $startingUnits = array();
		function __construct()
		{
			if (isset($this->countryUnits))
				$this->startingUnits = $this->countryUnits;
		}
	}
	
	$pregame = $Variant->adjudicatorPreGame();
	
	foreach ($Variant->countries as $countryID => $name)
	{
		$oldUnits = "";
		foreach ($pregame->startingUnits[$name] as $terrName => $unitType)
			$oldUnits .= '<input type="hidden" name="oldUnits['.$terrName.']" value="'.$unitType.'">';

		$addUnitSelect='<option value="0" selected>Add a starting unit:</option>';
		foreach ($terrNameByID as $id => $TerrName)
			$addUnitSelect .= '<option value="'.$TerrName.'">'.$TerrName.'</option>';

		print '<div class="hr"></div>
			<table>
				<tr>
					<td><b>'.$name.':</b></td>
					<td colspan="3">
						<form style="display: inline" method="get" name="addUnit">
							<input type="hidden" name="tab" value="Units">
							'.$oldUnits.'
							<input type="hidden" name="action" value="addUnit">
							<input type="hidden" name="variantID" value="'.$variantID.'">
							<input type="hidden" name="countryID" value="'.$countryID.'">
							<select name="TerrName" onchange="this.form.submit();">'.$addUnitSelect.'</select>
						</form>
					</td>
				</tr>';
	
		foreach ($pregame->startingUnits[$name] as $terrName => $unitType)
		{
			print '
				<tr>
                    <td></td>
					<td>'.$terrName.'</td>
					<td>
						<form style="display: inline" method="get" name="changeUnit">
							<input type="hidden" name="tab" value="Units">
							<input type="hidden" name="action" value="changeUnit">
							<input type="hidden" name="variantID" value="'.$variantID.'">
							<input type="hidden" name="countryID" value="'.$countryID.'">
							<input type="hidden" name="TerrName" value="'.$terrName.'">
							'.$oldUnits.'
							<select name="unitType" onchange="this.form.submit();">
								<option value="Army" '.($unitType == 'Army' ? 'selected' : '').'>Army</option>
								<option value="Fleet"'.($unitType == 'Army' ? '' : 'selected').'>Fleet</option>
							</select>
						</form>
					</td>
					<td>
						<form style="display: inline" method="get" name="deleteUnit">
							<input type="hidden" name="tab" value="Units">
							<input type="hidden" name="action" value="deleteUnit">
							<input type="hidden" name="variantID" value="'.$variantID.'">
							<input type="hidden" name="countryID" value="'.$countryID.'">
							<input type="hidden" name="TerrName" value="'.$terrName.'">
							'.$oldUnits.'
							<input type="submit" class="form-submit" name="deleteUnit" value="Delete unit" />
						</form>
					</td>
					<td style=" width: 100%;"></td>
				</tr>';
		}
		print '</table>';
	}
}

print '<div class="hr"></div></div>';
libHTML::footer();

?>
