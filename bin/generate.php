<?php
require '../www/BibleLine.class.php';

$sp = 0;
$b = new BibleLine($sp);

for ($i = 0; $i < 10; $i++) {
    echo $b->getLine();
    $b->changeSp(++$sp % 3);
}

exit;
