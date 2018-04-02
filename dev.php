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

require_once('header.php');

if(!$User->type['User'])
	libHTML::error(l_t("You can't use the developer panel, you're using a guest account."));

// The Variant-ID for the map
$variantID = isset($_REQUEST['variantID']) ? $_REQUEST['variantID'] : '0'; 
if (!(isset(Config::$variants[$variantID]))) $variantID = 0;
if (isset(Config::$hiddenVariants) && in_array($variantID,Config::$hiddenVariants) && $User->type['Guest']) $variantID = 0;

libHTML::starthtml();

print '<div class="content">';

$tabs = array();

$tabs['Base']     =l_t("Manage variant settings");
$tabs['Colors']   =l_t("Assign colors to your countries");
$tabs['Map']      =l_t("Edit your map");
$tabs['Units']    =l_t("Manage your starting units");
$tabs['Files']    =l_t("Magage your files");
$tabs['Preview']  =l_t("Preview of the variant-page");
$tabs['MapResize']=l_t("Resize your maps.");

$tab = 'Base';
$tabNames = array_keys($tabs);

if( isset($_REQUEST['tab']) && in_array($_REQUEST['tab'], $tabNames) )
	$tab = $_REQUEST['tab'];

print '<div class="gamelistings-tabs">';

foreach($tabs as $tabChoice=>$tabTitle)
	print '<a title="'.$tabTitle.'" href="dev.php?variantID='.$variantID.'&tab='.$tabChoice.
	 ( ( $tab == $tabChoice ) ?  '" class="current"' : '').'">'.l_t($tabChoice).'</a>';

print '</div><br>';

// Define some form-elemets needed by all dev-tools.
asort(Config::$variants);
$selectVariantForm = 
	'<form style="display: inline" method="get" name="set_map">
	<input type="hidden" name="tab" value="'.$tab.'" />
	<select name="variantID" onchange="this.form.submit();">'
	.($variantID == 0 ? '<option value="0" selected>Choose a variant...</option>' : '');
foreach ( Config::$variants as $id=>$name )
	$selectVariantForm .= '<option value="'.$id.'"'.($id == $variantID ? ' selected':'').'>'.$name.'</option>';
$selectVariantForm .= '</select></form>';

if ($User->id == 5)
	$edit = true;
else
	$edit = false;

if (isset(Config::$devs))
	if (array_key_exists($User->username, Config::$devs)) 
	 if (in_array(Config::$variants[$variantID], Config::$devs[$User->username]))
		$edit = true;

if ($variantID != 0 && $tab != 'Base')
{
    $Variant = libVariant::loadFromVariantID($variantID);
    libVariant::setGlobals($Variant);
}
	
switch($tab)
{
	case 'Base':
		require_once(l_r('dev/base.php'));
		break;
	case 'Colors':
		require_once(l_r('dev/colors.php'));
		break;
	case 'Map':
		require_once(l_r('dev/map.php'));
		break;
	case 'Units':
		require_once(l_r('dev/units.php'));
		break;
	case 'Files':
		require_once(l_r('dev/files.php'));
		break;
	case 'Preview':
		require_once(l_r('dev/preview.php'));
		break;
	case 'MapResize':
		require_once(l_r('dev/mapresize.php'));
		break;
	default:
		require_once(l_r('dev/config.php'));
}

print '</div>';
libHTML::footer();

?>
