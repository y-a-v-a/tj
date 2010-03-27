<?php
error_reporting(0);

$url = "http://www.metropolism.com";
$req = '/magazine/';

$years = array();
$issues = array();

for ($i = 4; $i <= date('y'); $i++) {
	array_push($years, 2000 + $i);
}

for ($j = 1; $j <= 6; $j++) {
	array_push($issues, '-no' . $j);
}
$req .= $years[rand(0, count($years) - 1)] . $issues[rand(0, count($issues) - 1)] . '/';

$doc = new DOMDocument();
$doc->strictErrorChecking = false;
@$doc->loadHTML(@file_get_contents($url . $req));
$content = $doc->getElementById('content');
if (get_class($content) !== 'DOMElement') {
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
	echo 'axel';
	die;
}
$baseContentLink = $artLinks[rand(0,count($artLinks) - 1)];
$baseDoc = new DOMDocument();
$baseDoc->strictErrorChecking = false;
$baseDoc->encoding = 'UTF-8';
@$baseDoc->loadHTML(@file_get_contents($url . $baseContentLink));
$baseContent = $baseDoc->getElementById('articleContent');

preg_match("/[A-Z]{1}[a-z ][\w\s]*\. /",$baseContent->nodeValue, $matches);

echo isset($matches[0]) ? $matches[0] : 'axel';

exit;



