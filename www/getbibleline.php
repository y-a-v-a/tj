<?php
/**
 * God is a TJ by ax710 and vincentbruijn
 * @package God is a TJ
 * @copyright 2010 vincent bruijn, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 * @version 0.2 may 2010
 * exmaple sources:
 * http://www.gutenberg.org/dirs/etext05/drb4310.txt
 */

// set charset
header("Content-Type: text/html; charset=UTF-8");
error_reporting(0);

if (!isset($_POST['sp'])) {
	header('X-Exception: send correct get params');
	echo 'No direct access';
	exit;
}
$sp = (int) $_POST['sp'];

// mirrors to choose from
$urls= array(
	"ftp://eremita.di.uminho.pt/pub/gutenberg/etext05",
	"http://www.gutenberg.org/dirs/etext05",
	"http://www.gutenberg.lib.md.us/etext05",
	"ftp://indian.cse.msu.edu/pub/mirrors/Gutenberg/etext05",
	"http://gutenberg.mirrors.tds.net/pub/gutenberg.org/etext05",
	"http://mirrors.xmission.com/gutenberg/etext05",
	"ftp://sunsite.informatik.rwth-aachen.de/pub/mirror/ibiblio/gutenberg/etext05",
	"ftp://cis.uniroma2.it/gutenberg/etext05"
	);
$url = $urls[rand(0,count($urls) - 1)];
$req = '/';

// bible contains 67 books
$book = rand(0,73);
if ($book < 10) {
	$book = '0' . $book;
}

$req .= 'drb' . $book . '10.txt';

// for debugging
header('X-Url: ' . $url . $req);

$cnt = @file_get_contents($url . $req);

if ($cnt == false) {
	// return wildcard
	header('X-Exception: No artlinks');
	echo 'axel';
	die;
}
// strip meta-data to get main text
$cnt = strstr($cnt, '1:1');
// strip meta-data from end of file
$cnt = strrev(strstr(strrev($cnt), strrev('*** END')));

$cnt = substr($cnt, 0, strlen($cnt) - strlen('*** END'));

// do some regexp to get the right sentence part
switch ($sp) {
	case '0':
		preg_match_all("/[A-Z]{1}[a-z]*[ ]{1}([a-z0-9:\-,]*[ ]){4,12}/",$cnt, $matches);
		break;
	case '1':
		preg_match_all("/[ ]{1}[a-z]{1}([A-Za-z\-,:]*[ ]){6,}/",$cnt, $matches);
		break;
	case '2':
		preg_match_all("/([ ]+?[a-z][A-Za-z\-,:]*){6,13}([\.\?!]){1}/",$cnt, $matches,PREG_PATTERN_ORDER);
		break;
}
// return stuff
//echo isset($matches[0]) && count($matches[0]) > 0 ? $matches[0][rand(0, count($matches[0]) - 1)] : 'axel';
if (isset($matches[0]) && count($matches[0]) > 0) {
	echo $matches[0][rand(0, count($matches[0]) - 1)];
} else {
	header('X-Exception: Match error');
	echo 'axel';
}

exit;



