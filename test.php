<?php
use nuffy\BriLib\BriHelper;

require_once __DIR__.'/vendor/autoload.php';

$boards = BriHelper::parseFile(realpath('input-test.BRI'));

foreach($boards as $board){
    echo "Board ".$board->getBoardNumber().":\n$board\n\n";
}
exit;