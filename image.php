<?php

function scrobbleimage($artist, $track, $album, $stamp, $upper) {

// $stamp = str_replace($stamp, "?s=90", "?s=50");

// Load the stamp and the photo to apply the watermark to
$stamp = imagecreatefrompng($stamp . '&s=50');

$cc = imagecreatefrompng('https://licensebuttons.net/i/l/by/transparent/ff/ff/ff/76x22.png');
//$cc = imagecreatefrompng('https://licensebuttons.net/i/l/by-sa/eeeeee/66/22/11/76x22.png');
$im = imagecreatefrompng('bitmap.png');

// Set the margins for the stamp and get the height/width of the stamp image
$marge_left = 21;
$marge_top = 35;
// This should be 80
$sx = imagesx($stamp);
$sy = imagesy($stamp);

$stomp = "1742415640";
$username = "mattl";

// average length 19

$tav = 19 + 10;

//$track = "TRACKSquirrel And G-Man 24 Hour Party People Plastic Face Carnt Smile (White Out)";

// average length 21
$aav = 21;
//$artist = "ARTISTSquirrel And G-Man 24 Hour Party People Plastic Face Carnt Smile (White Out)";

// average length 22
$bav = 22 + 15;

//$album = "Squirrel And G-Man 24 Hour Party People Plastic Face Carnt Smile (White Out)";
//$album = "When the Pawn Hits the Conflicts He";

if (strlen($track) > $tav) {
$track = substr($track, 0, $tav) . "...";
}

if (strlen($artist) > $aav) {
$artist = substr($artist, 0, $aav) . "...";
}

if (strlen($album) > $bav) {
$album = substr($album, 0, $bav) . "...";
}

if ($upper) {

$track = strtoupper($track); 
$album = strtoupper($album); 
$artist = strtoupper($artist); 

}

//$date = "Wed, 19 Mar 2025 20:20:40 +0000";

$white = imagecolorallocate($im, 255, 255, 255);
$notwhite = imagecolorallocate($im, 230, 230, 230);

$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$bg = imagecolorallocate($im, 26,26,26);
$lime = imagecolorallocate($im, 102,255,0);
// imagefilledrectangle($im, 90, 5, 450, 27, $grey);
// imagefilledrectangle($im, 90, 30, 450, 58, $lime);
// imagefilledrectangle($im, 90, 61, 450, 85, $grey);

// Replace path by your own font path
$semi = './semi.ttf';
$ebold = './ebold.ttf';
$med = './med.ttf';

// Add the text
imagettftext($im, 15, 0, 95, 24, $white, $ebold, $artist);
imagettftext($im, 11, 0, 95, 50, $lime, $med, $track);
imagettftext($im, 9, 0, 95, 78, $notwhite, $semi, $album);
//imagettftext($im, 12, 0, 95, 80, $white, $font, "CC BY 4.0");

// Copy the stamp image onto our photo using the margin offsets and the photo 
// width to calculate positioning of the stamp. 
imagecopy($im, $stamp, $marge_left, $marge_top, 0, 0, imagesx($stamp), imagesy($stamp));

imagefilledrectangle($im, 451, 0, 500, 90, $bg);
imagefilledrectangle($im, 458, 0, 500, 20, $bg);

imagettftext($im, 6, 90, 471, 83, $grey, $semi, "CC BY 4.0");

imagecopy($im, $cc, 430, 0, 0, 0, imagesx($cc), imagesy($cc));

// Output
//header('Content-type: image/png');

return imagepng($im);

}

header('Content-type: image/png');
echo scrobbleimage("Oasis", "Wonderwall", "What's the story (morning glory)", "https://www.libravatar.org/avatar/c743712e444fe0b552a4b4252e02761b?s=90&d=monsterid",'1');



?>