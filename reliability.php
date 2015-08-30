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
 * @package Base
 * @subpackage Static
 */

require_once('header.php');
require_once('lib/reliability.php');

libHTML::starthtml();

print libHTML::pageTitle(l_t('Are there any limitations for joining new games?'),l_t('A quick guide explaining why it\'s important to enter your orders and not CD.'));

require_once(l_r('locales/English/reliability.php'));

print '</div>';
libHTML::footer();

?>
