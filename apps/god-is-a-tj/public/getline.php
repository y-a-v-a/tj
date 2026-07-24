<?php
/**
 * God is a TJ by ax710 and vincentbruijn
 * @package God is a TJ
 * @copyright 2010 vincent bruijn, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 * @version 0.2 may 2010
 * @version 0.3 jul 2026
 * exmaple sources:
 * http://www.gutenberg.org/dirs/etext05/drb4310.txt
 */

// set charset
header("Content-Type: text/html; charset=UTF-8");
error_reporting(0);

require __DIR__ . '/../../../shared/src/TextJockey.php';

if (!isset($_POST['sp'])) {
	header('X-Exception: send correct get params');
	echo 'No direct access';
	exit;
}
$sp = (int) $_POST['sp'];

$cnt = @file_get_contents(__DIR__ . '/../../../data/bible.txt');

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

$line = TextJockey::extract($cnt, $sp);

if ($line === false) {
	header('X-Exception: Match error');
	echo 'axel';
	exit;
}
echo $line;

exit;
