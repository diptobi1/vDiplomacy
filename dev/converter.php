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

print '<b>Variant: '.$selectVariantForm.'</b>';

$edit = false;
if ($edit != true)
{
	print "<b> - Only sysadmins and devs can use the Converter tool.</b></div>";
	libHTML::footer();
	exit;
}

if (count($_FILES) > 0) {

	$coasts = array("n"=>"North", "s"=>"South", "e"=>"East", "w"=>"West");

	$countryfile = file_get_contents($_FILES['countryfile']['tmp_name']);
	$mapfile     = file_get_contents($_FILES['mapfile']['tmp_name']);
	$gamfile     = file_get_contents($_FILES['gamfile']['tmp_name']);
	$rgnfile     = file_get_contents($_FILES['rgnfile']['tmp_name']);
	$bmpfile     = file_get_contents($_FILES['bmpfile']['tmp_name']);
	$smallfact   = $_REQUEST['smallmapfactor'];
	$largefact   = $_REQUEST['mapfactor'];
	
	$powers=array();

	// Get powers
	$countryfile = preg_replace("/#.+/", "", $countryfile); // Remove comments;
	$lines = explode("\n", $countryfile);
	foreach ($lines as $key => $value)
	foreach ($lines as $key => $value)
	{
		$line = explode(" ", $value);
		if (count($line) > 3)
			$powers[$line[2]]=$line[0];
	}

	foreach ($powers as $id => $name)
		print $name.": ".$id."<br>";
	echo "<br><hr><br>";
	print 'public $countries=array(';
	foreach ($powers as $id => $name)
		print "'".$name."',";
	echo ")<br>";
		
	// Get territory and border information:
	
	// Get the map file and put it in easy-to-use arrays
	$mapfile = preg_replace("/#.+/", "", $mapfile); // Remove comments;
	$lines = explode("\n", $mapfile);
	$phases = array("territories", "connections","not used","not used");
	$connections = array(); $phase = 0;
	foreach ($lines as $key => $value) {
		if (preg_match("/-1/", $value)) {
			$phase++;
			continue;
		}
		switch ($phases[$phase]) {
			case "territories": 
				$line = explode(",", $value);
				$country = addslashes($line[0]);
				if ($country == "") continue;
				$line[1] = trim($line[1]);
				$type = "";
				$supply = "No";
				$codes = trim(substr($line[1], 0, strpos($line[1], " ")));
				$abbrs = explode(" ", trim(substr($line[1], strpos($line[1], " "))));
				$abbr = $abbrs[0];
				$startingcode = "";
				for ($i = 0; $i < strlen($codes); $i++) {
					if ($codes[$i] == "w") $type = "Sea";
					else if ($codes[$i] == "l") $type = "Land/Coast";
					else if ($codes[$i] == "x") {
						$type = "Land/Coast";
						$supply = "Yes";
					}
					else {
						$startingcode = "$codes[$i]"; // It's a starting SC for a country
						$supply = "Yes";
						$type = "Land/Coast";
					}
				}
				if (trim($startingcode) == "") $startingcode = "Neutral";
				else $startingcode = $powers[$startingcode];
				$territories[strtoupper($abbr)] = array("country"=>$country, "abbr"=>$abbr, "type"=>$type, "supply"=>$supply, "hometerr"=>$startingcode, "coast"=>"No");
				break;
			case "connections":
				$line = explode(": ", $value);
				if ($line[0] == "") break;
				$from = $line[0];
				$to = trim($line[1]);
				$dash = strpos($from, "-");
				$fromTerr = substr($from, 0, $dash);
				$fromType = substr($from, ($dash+1), 2);
				$toTerrs = explode(" ", str_replace("  ", " ", $to));
				if ($fromType[1]=="c") $type = "fleet";
				else $type = "army";
				foreach ($toTerrs as $terr) {
					$terr = trim($terr);
					$opt = $coast1 = $coast2 = "";
					if (stristr($terr, "/")) {
						$slash = strpos($terr, "/");
						$terr = substr($terr, 0, $slash);
						$opt = substr($terr, ($slash+1), 2);
					}
					$fleetsPass = $armysPass = "No";
					if ($type == "fleet") {
						$fleetsPass = "Yes";
					} else {
						$armysPass = "Yes";
					}
					if ($fromType != "xc" && $fromType != 'mv') {
						$coast1 = $coasts[$fromType[0]];
					}
					if ($opt != "" && $opt[1] == "c") {
						$coast2 = $coasts[$opt[0]];
					}
					$con = array("fromTerr"=>$fromTerr, "toTerr"=>$terr, "coast1"=>$coast1, "coast2"=>$coast2);
					if ($index = array_search($con, $connections)) { // We already have an entry created by the other type, we just need to add our fleet/army to it.
						if ($type == "fleet") {
							$data[$index]['fleetsPass'] = "Yes";
						} else {
							$data[$index]['armysPass'] = "Yes";
						}
					} else {
						$connections[] = $con;
						$data[] = array("fleetsPass"=>$fleetsPass, "armysPass"=>$armysPass);
					}
				}
			default: break;
		}
	}

	// First update our landlocked countries, but make sure to take into account if we've already determined that a fleet can move there (from borders)
	foreach ($territories as $terr => $territory) {
		$foundSea = false;
		$alreadyFleet = false;
		if ($territory['type'] != "Land/Coast") continue;
		foreach ($connections as $index => $border) {
			if (strtoupper($territory['abbr']) == strtoupper($border['fromTerr'])) {
				if ($data[$index]['fleetsPass'] == "Yes") $alreadyFleet = true;
				if (!empty($territories[strtoupper($border['toTerr'])]['type']))
					if ($territories[strtoupper($border['toTerr'])]['type'] == "Sea") $foundSea = true;
			} 
		}
		if (!$foundSea && !$alreadyFleet) {
			$territories[$terr]['type'] = "Land";
		}
	}

	// Now that we have all the seas and landlocked countries, we can set the rest of the Land/Coast to Coast
	foreach ($territories as $terr => $territory) {
		if ($territory['type'] == "Land/Coast") $territories[$terr]['type'] = "Coast";
	}

	$cs = array();
	foreach ($connections as $key => $value) {
		if ($value['coast1'] != "") {
			$cabb = strtoupper($value['fromTerr']) . " (".$value['coast1']." Coast)";
			$c = $territories[strtoupper($value['fromTerr'])]['country'] . " (".$value['coast1']." Coast)";
			if (!in_array($c, $cs)) {
				$territories[strtoupper($value['fromTerr'])]['coast'] = "Parent";
				$territories[$cabb] = $territories[strtoupper($value['fromTerr'])];
				$territories[$cabb]['country'] = $c;
				$territories[$cabb]['supply'] = "No";
				$territories[$cabb]['coast'] = $value['coast1'];
				$cs[] = $c;
			}
		}
		if ($value['coast2'] != "") {
			$cabb = strtoupper($value['toTerr']) . " (".$value['coast2']." Coast)";
			$c = $territories[strtoupper($value['toTerr'])]['country'] . " (".$value['coast2']." Coast)";
			if (!in_array($c, $cs)) {
				$territories[strtoupper($value['toTerr'])]['coast'] = "Parent";
				$territories[$cabb] = $territories[strtoupper($value['toTerr'])];
				$territories[$cabb]['country'] = $c;
				$territories[$cabb]['supply'] = "No";
				$territories[$cabb]['coast'] = $value['coast2'];
				$cs[] = $c;
			}
		}
	}

	$rgnfile   = preg_replace("/Variant.+/", "", $rgnfile); // Sometimes 1st line is a refference to a path on someone elses harddrive;
	$rgnfile   = preg_replace("/#.+/", "", $rgnfile); // Remove comments;
	$lines     = explode("\n", $rgnfile);
	$smallfact = $_REQUEST['smallmapfactor'];
	$largefact = $_REQUEST['mapfactor'];

	$img = imagecreatefromstring($bmpfile);
	if ($img === false) print "Unknown Imageformat. Please convert to JPG.";
	
	$keys = array_keys($territories);
	$terrID=0;
	$scanlines=0;
	$mode="UnitXY";
	$colors=array();
	
	$terrName=$keys[$terrID];
	foreach ($lines as $key => $value) {
		if ($value == "") continue;

		switch ($mode) {

			case "UnitXY":
				list($x,$y) = explode(",",$value);
//				print "Terr: ".$terrName."<br>";
//				print "X:".$x." - y:".$y."<br>";
				$territories[$terrName]['sx']=$smallfact * $x;
				$territories[$terrName]['sy']=$smallfact * $y;
				$territories[$terrName]['x'] =$largefact * $x;
				$territories[$terrName]['y'] =$largefact * $y;
				if (strpos($terrName," Coast)") > 0)
					$mode="Scanlines";
				else
					$mode="TextXY";
				break;
			case "TextXY":
				list($x,$y) = explode(",",$value);
//				print "TxtX:".$x." - Txty:".$y."<br>";
				$mode="Scanlines";
				break;
			case "Scanlines":
				if ($img === false) break;
				if ($scanlines==0)
				{
					$scanlines = $value;
					if ($territories[$terrName]["type"]=='Sea')
					{
						$col=imagecolorallocate($img,197,223,234);
					}
					else
					{
						do {
							$r=rand(0,255); $g=rand(0,255); $b=rand(0,255);
						} while (in_array($r.$g.$b, $colors));
						$colors[]=$r.$g.$b;
						$col=imagecolorallocate($img,$r,$g,$b);
					}					
				}
				else
				{
					$scanlines= $scanlines -1;
					list($x,$y,$length) = explode(" ",$value);
//					print "Scanline (".$scanlines."):".$x." ".$y." ".$length."<br>";				
					imageline ($img, $x, $y, $x + $length, $y, $col);
				}
				if ($scanlines==0)
				{
					$mode="UnitXY";
					if (array_key_exists($keys[$terrID]." (East Coast)",$territories)
						&& !isset($territories[$keys[$terrID]." (East Coast)"]['sx']))
					{
						$terrName=$keys[$terrID]." (East Coast)";
					}
					elseif (array_key_exists($keys[$terrID]." (North Coast)",$territories)
						&& !isset($territories[$keys[$terrID]." (North Coast)"]['sx']))
					{
						$terrName=$keys[$terrID]." (North Coast)";
					}
					elseif (array_key_exists($keys[$terrID]." (South Coast)",$territories)
						&& !isset($territories[$keys[$terrID]." (South Coast)"]['sx']))
					{
						$terrName=$keys[$terrID]." (South Coast)";
					}
					elseif (array_key_exists($keys[$terrID]." (West Coast)",$territories)
						&& !isset($territories[$keys[$terrID]." (West Coast)"]['sx']))
					{
						$terrName=$keys[$terrID]." (West Coast)";
					}
					else
					{
						$terrID = $terrID + 1;
						$terrName=$keys[$terrID];
					}
				}
			default:
				break;
		}
	}
	imagepng($img,'rp2wd_map.png');

	$gamfile = preg_replace("/#.+/", "", $gamfile); // Remove comments;
	$lines = explode("\n", $gamfile);
	$searchstart=9;
	$keys = array_keys($powers);
	$powerIndex=0;
	echo "<br><hr><br>";
	print 'protected $countryUnits = array(<br>';

	foreach ($lines as $key => $value)
	{
		if ($value == "") continue;
		$searchstart=$searchstart -1;
		if ($searchstart > 0) continue;
		if ($powerIndex < count($keys))
		{
			print " '".$powers[$keys[$powerIndex]]."'=> array(";
			$line = explode(" ",$value);
			foreach ($line as $parameter)
			{
				if ($parameter == 'A')
					$unit = 'Army';
				elseif ($parameter == 'F')
					$unit = 'Fleet';
				else
				{
					$abbr = preg_replace("/\r|\n/s", "", $parameter);
					print "'".$territories[strtoupper($abbr)]["country"]."' => '".$unit."', ";
				}
			}
			print ")<br>";
			$powerIndex++;
			$searchstart=3;
		}
	}
	
	echo "<br><hr><br>";
	echo "Territory information: ('Terrname', 'Type', 'Supply', 'Owner', 'X', 'Y', 'SX', 'SY', 'Coast')<br>";
	foreach ($territories as $id=>$territory)
	{
		if (!(isset($territory["x"])))  $territory["x"]  = 0;
		if (!(isset($territory["y"])))  $territory["y"]  = 0;
		if (!(isset($territory["sx"]))) $territory["sx"] = 0;
		if (!(isset($territory["sy"]))) $territory["sy"] = 0;
		
		print "&nbsp&nbsparray('".$territory["country"]."', '".$territory["type"]."', '".$territory["supply"]."', '".
			$territory["hometerr"]."', ".(int)$territory["x"].", ".(int)$territory["y"].", ".$territory["sx"].", ".$territory["sy"]."),<br>";
	}

	echo '
		foreach($territoryRawData as $territoryRawRow)
		{
			list($name, $type, $supply, $country, $x, $y, $sx, $sy)=$territoryRawRow;
			if( $country==\'Neutral\' )
				$countryID=0;
			else
				$countryID=$this->countryID($country);
				
			new InstallTerritory($name, $type, $supply, $countryID, $x, $y, $sx, $sy);
		}
		unset($territoryRawData);';
			
	echo "<br><hr><br>Border information ('Terr1', 'Terr2', 'Fleets', 'Army'):<br>";
	$count = 0;
	$outputted = array();
	$datacopy = $data;
	foreach ($connections as $index => $border) {
		$count++;
		$fromTerr = $territories[strtoupper($border['fromTerr'])]['country'];
		$toTerr = $territories[strtoupper($border['toTerr'])]['country'];
		if ($border['coast1'] != "") $fromTerr .= " (" . $border['coast1'] . " Coast)";
		if ($border['coast2'] != "") $toTerr .= " (" . $border['coast2'] . " Coast)";

		if (in_array(array($fromTerr, $toTerr), $outputted)) continue; // Don't duplicate

		echo "  array('".$fromTerr."', '".$toTerr."', '".$datacopy[$index]["fleetsPass"]."', '".$datacopy[$index]["armysPass"]."'";
		echo ")";
		$outputted[] = array($fromTerr, $toTerr);
		if (count($connections) != $count) {
			echo ",<br>";
		} else {
			echo ";<br>";
		}
	}

	print '<img src="rp2wd_map.png">';
	
} else {
	print
		'<div class="hr"></div>
		<b>Realpolitic converter:<br></b>
		<form method="POST" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
		<style type="text/css"> td { padding:2px; white-space: nowrap;} </style>
		<table>
			<tr><td>Country file <b>(.cnt)</b>:</td>              <td><input type="file" name="countryfile"></td> <td style=" width: 100%;"></td></tr>
			<tr><td>Territories / border file <b>(.map)</b>:</td> <td><input type="file" name="mapfile">    </td> <td style=" width: 100%;"></td></tr>
			<tr><td>Position file <b>(.rgn)</b>:            </td> <td><input type="file" name="rgnfile">    </td> 
				<td>smallmap-factor:</td> <td><input size="5" name="smallmapfactor" value="" /></td>
				<td>map-factor:     </td> <td><input size="5" name="mapfactor" value="" />     </td>              <td style=" width: 100%;"></td></tr>
			<tr><td>Starting positions file <b>(.gam)</b>:  </td> <td><input type="file" name="gamfile">    </td> <td style=" width: 100%;"></td></tr>
			<tr><td>Black&white map <b>(.png)</b>:          </td> <td><input type="file" name="bmpfile">    </td> 
				<td colspan="4">(convert bmp to png bevore processing)</td>                                                   <td style=" width: 100%;"></td></tr>
		</table>
		<input type="submit" value="Submit Realpolitic files">
		</form>
		<div class="hr"></div>';
}
	
print '</div>';
libHTML::footer();

?>
