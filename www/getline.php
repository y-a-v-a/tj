<?php
/**
 * Neuropolis N by ax710 and vincentbruijn
 * @package Neuropolis N
 * @copyright 2010 vincent bruijn, ax710
 * @copyright 2017 y_a_v_a, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 * @version 0.1 may 2010
 * @version 0.2 oct 2017
 */
error_reporting(0);
sleep(2);
if (!isset($_POST['sp'])) {
	header('X-Exception: send correct get params');
	echo 'No direct access';
	exit;
}
$sp = (int) $_POST['sp'];

$files = glob('./cache/*.txt');
$file = $files[array_rand($files)];

$text = @file_get_contents($file);

if (!$text || strlen($text) === 0) {
	header('X-Exception: No artlinks');
	echo 'axel';
	die;
}


header("Content-Type: text/html; charset=UTF-8");
switch ($sp) {
	case '0':
		preg_match_all("/[A-Z]{1}[a-z]*[ ]{1}([a-z0-9:\-,]*[ ]){4,12}/",$text, $matches);
		break;
	case '1':
		preg_match_all("/[ ]{1}[a-z]{1}([A-Za-z\-,:]*[ ]){6,}/",$text, $matches);
		break;
	case '2':
	default:
		preg_match_all("/([ ]+?[a-z][A-Za-z\-,:]*){6,13}([\.\?!]){1}/",$text, $matches,PREG_PATTERN_ORDER);
		break;
}

//preg_match("/[A-Z]{1}[ ]/",$text, $matches);
// print_r($matches);
// echo str_repeat('<br />', 4);
// var_dump($text);
echo isset($matches[0]) && count($matches[0]) > 0 ? $matches[0][rand(0, count($matches[0]) - 1)] : 'axel';
//echo isset($matches[0]) ? $matches[0] : 'axel';

exit;



