<?php
require '../www/BibleLine.class.php';

$sp = 0;
$b = new BibleLine($sp);

$text = '';
$now = date("Ymd-His");

while (str_word_count($text) < 50000) {
    $line = $b->getLine();
    echo $line;
    $text .= $line;
    file_put_contents('./text' . $now . '.txt', $line, FILE_APPEND);
    $b->changeSp(++$sp % 3);    
}

exit;
