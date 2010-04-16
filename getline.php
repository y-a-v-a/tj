<?php
error_reporting(0);
sleep(2);
if (!isset($_GET['sp'])) {
	header('X-Exception: send correct get params');
	echo 'No direct access';
	exit;
}
$sp = (int) $_GET['sp'];
$url = "http://www.metropolism.com";
$req = '/magazine/';

$years = array();
$issues = array();

for ($i = 4; $i <= date('y'); $i++) {
	array_push($years, 2000 + $i);
}
$y = $years[rand(0, count($years) - 1)];
$m = 6; // Metropolis M issues every 2 months

if ($y == date('Y')) { // keep up with the current issues
	$m = floor(date('n') / 2);
	$m = $m == 0 ? ++$m : $m;
}

for ($j = 1; $j <= $m; $j++) {
	array_push($issues, '-no' . $j);
}
$req .= $y . $issues[rand(0, count($issues) - 1)] . '/';

$doc = new DOMDocument();
$doc->strictErrorChecking = false;
$baseDoc->encoding = 'UTF-8';
@$doc->loadHTML(@file_get_contents($url . $req));
$content = $doc->getElementById('content');
if (get_class($content) !== 'DOMElement') {
	header('X-Exception: Content is no DOMElement');
	echo 'axel';
	die;
}
$links = $content->getElementsByTagName('a');

$linkStrings = array();
for ($p = 0; $p < $links->length; $p++) {
	array_push($linkStrings, $links->item($p)->attributes->getNamedItem('href')->value);
}

$artLinks = array();
foreach ($linkStrings as $link) {
	if (strstr($link, $req) !== false) {
		array_push($artLinks, $link);
	}
}
if (count($artLinks) == 0) {
	header('X-Exception: No artlinks');
	echo 'axel';
	die;
}
$baseContentLink = $artLinks[rand(0,count($artLinks) - 1)];
$baseDoc = new DOMDocument();
$baseDoc->strictErrorChecking = false;
$baseDoc->encoding = 'UTF-8';
@$baseDoc->loadHTML(@file_get_contents($url . $baseContentLink));
$baseContent = $baseDoc->getElementById('articleContent');
// echo $baseContent->nodeValue;
// preg_match("/[A-Z]{1}[a-z ][\w\s]*\. /",$baseContent->nodeValue, $matches);
header("Content-Type: text/html; charset=UTF-8");
switch ($sp) {
	case '0':
		preg_match_all("/[A-Z]{1}[a-z]*[ ]{1}([a-z0-9:\-,]*[ ]){4,12}/",$baseContent->nodeValue, $matches);
		break;
	case '1':
		preg_match_all("/[ ]{1}[a-z]{1}([A-Za-z\-,:]*[ ]){6,}/",$baseContent->nodeValue, $matches);
		break;
	case '2':
		preg_match_all("/([ ]+?[a-z][A-Za-z\-,:]*){6,13}([\.\?!]){1}/",$baseContent->nodeValue, $matches,PREG_PATTERN_ORDER);
		break;
}

//preg_match("/[A-Z]{1}[ ]/",$baseContent->nodeValue, $matches);
// print_r($matches);
// echo str_repeat('<br />', 4);
// var_dump($baseContent->nodeValue);
echo isset($matches[0]) && count($matches[0]) > 0 ? $matches[0][rand(0, count($matches[0]) - 1)] : 'axel';
//echo isset($matches[0]) ? $matches[0] : 'axel';

exit;



