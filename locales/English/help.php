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

/**
 * @package Base
 * @subpackage Static
 */

print libHTML::pageTitle('webDiplomacy Help and Links','Links to pages with more information about webDiplomacy and this installation.');
?>
<ul class="formlist">

<li><a href="rules.php">Rulebook/Contacting the Mods</a></li>
<li class="formlistdesc">The webDiplomacy rulebook. Moderator and Co-owner emails.</li>
 
<li><a href="intro.php">The intro to Diplomacy</a></li>
<li class="formlistdesc">An introduction to playing webDiplomacy. Gives details on unit types, move types, and the basic rules of webDiplomacy.</li>

<li><a href="faq.php">FAQ</a></li>
<li class="formlistdesc">The webDiplomacy FAQ (Frequently asked questions) and information on donating.</li>

<li><a href="profile.php">Find a user</a></li>
<li class="formlistdesc">Search for a user account registered on this server if you know their user ID number, username, or e-mail address.</li>

<li><a href="features.php">VDiplomacy features</a></li>
<li class="formlistdesc">Features you should be aware of (not available at webdiplomacy.net).</li>

<li><a href="rules.php">Etiquette</a></li>
<li class="formlistdesc">The webDiplomacy etiquette.</li>

<li><a href="hof.php">vDip Hall of fame</a></li>
<li class="formlistdesc">The pros of this server; the top 100! based on an Elo-like algorithm</li>

<li><a href="recentchanges.php">Recent changes</a></li>
<li class="formlistdesc">Recent changes to the webDiplomacy software.</li>

<li><a href="halloffame.php">Hall of fame</a></li>
<li class="formlistdesc">The pros of this server; the top 100! based on total DPoints.</li>

<li><a href="points.php">webDiplomacy points</a></li>
<li class="formlistdesc">What points are for, how to win them, and how to get into the hall of fame.</li>

<li><a href="press.php">Press type information</a></li>
<li class="formlistdesc">Learn more about the several different communication systems available.</li>

<li><a href="variants.php">Variant information</a></li>
<li class="formlistdesc">A list of the variants available on this server, credits, and information on variant-specific rules.</li>

<li><a href="credits.php">Credits</a></li>
<li class="formlistdesc">The credits. Includes a list of active moderators.</li>

<li><a href="datc.php">DATC Adjudicator Tests</a></li>
<li class="formlistdesc">For experts; the adjudicator tests which show that webDiplomacy is true to the proper rules</li>

<li><a href="https://github.com/kestasjk/webDiplomacy">GitHub project page</a></li>
<li class="formlistdesc">Our github.com project page. From here you can make feature requests, inform us about bugs, or help improve the code.</li>

<li><a href="http://webdiplomacy.net/developers.php">Developer info</a></li>
<li class="formlistdesc">If you want to fix/improve/install webDiplomacy all the info you need to make it happen is here.</li>

<li><a href="http://sourceforge.net/projects/phpdiplomacy">Sourceforge.net project page</a></li>
<li class="formlistdesc">Last Updated: 2013-04-25.  Our old sourceforge.net project page.</li>

<li><a href="AGPL.txt">GNU Affero General License</a></li>
<li class="formlistdesc">The OSI approved license which applies to the vast majority of webDiplomacy.</li>

</ul>

<p>Didn't find the help or information you were looking for? Post a message in the <a href="contrib/phpBB3/" class="light">public forum</a>, or or contact the moderators at <a href="mailto:<?php print (isset(Config::$modEMail) ? Config::$modEMail : Config::$adminEMail); ?>" class="light">
<?php print (isset(Config::$modEMail) ? Config::$modEMail : Config::$adminEMail); ?></a>.</p>
