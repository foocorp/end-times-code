<?php

/* GNU FM -- a free network service for sharing your music listening habits

   Copyright (C) 2013 Free Software Foundation, Inc

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU Affero General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU Affero General Public License for more details.

   You should have received a copy of the GNU Affero General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

// $install_path="/var/gnu-fm/nixtape";
require_once('database.php');
require_once('user-menu.php');
require_once('templating.php');
require_once('data/Artist.php');
require_once('data/Album.php');
require_once('data/Track.php');
require_once('data/User.php');

$scrobble = $_GET['scrobble'];
$user = new User($_GET['user']);

$smarty->assign('me', $user);

		$aUserScrobbles = $user->getOneScrobble($user->uniqueid,$scrobble);

if ($aUserScrobbles) {

$currentTime = new DateTime();
$currentTime = DateTime::createFromFormat( 'U', $aUserScrobbles['time'] );
$formattedString = $currentTime->format( 'c' );


		$smarty->assign('track', $aUserScrobbles['track']);
		$smarty->assign('artist', $aUserScrobbles['artist']);
		$smarty->assign('stamp', $formattedString);
		$smarty->assign('album', $aUserScrobbles['time']);

} else {
	displayError("Scrobble not found", "Can't find that scrobble");
}


		$smarty->display('user-single-scrobble.tpl');




