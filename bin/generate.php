<?php
error_reporting(0);
require '../www/BibleLine.class.php';

$sp = 0;
$b = new BibleLine($sp);

$text = '';
$now = date("Ymd-His");
$fileName = './text' . $now . '.txt';

while (str_word_count($text) < 50000) {
    $line = $b->getLine();
    // echo $line;
    $text .= $line;
    file_put_contents($fileName, $line, FILE_APPEND);
    $b->changeSp(++$sp % 3);
}

// create a nice ending
 while (true) {
    $line = $b->getLine();
    if (preg_match('/\n\n/', $line)) {
        $line = strrev(strstr(strrev($line), "\n\n"));
        @file_put_contents($fileName, $line, FILE_APPEND);
        exit;
    }
    @file_put_contents($fileName, $line, FILE_APPEND);
    $b->changeSp(++$sp % 3);
}

exit;
