<?php
/**
 * Neuropolis N by ax710 and vincentbruijn
 * @package Neuropolis N
 * @copyright 2010 vincent bruijn, ax710
 * @copyright 2017 y_a_v_a, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 * @version 0.1 may 2010
 * @version 0.2 oct 2017
 * @version 0.3 jul 2026
 */
error_reporting(0);
sleep(2);

require __DIR__ . '/../../../shared/src/TextJockey.php';

if (!isset($_POST['sp'])) {
	header('X-Exception: send correct get params');
	echo 'No direct access';
	exit;
}
$sp = (int) $_POST['sp'];

$files = glob(__DIR__ . '/cache/*.txt');
$file = $files[array_rand($files)];

$text = @file_get_contents($file);

if (!$text || strlen($text) === 0) {
	header('X-Exception: No artlinks');
	echo 'axel';
	die;
}

header("Content-Type: text/html; charset=UTF-8");

$line = TextJockey::extract($text, $sp);

echo $line === false ? 'axel' : $line;

exit;
