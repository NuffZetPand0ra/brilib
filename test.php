<?php

use nuffy\BriLib\Bridge\Board;
use nuffy\BriLib\Formats\BriHelper;
use nuffy\cards\DeckFactory;

require_once __DIR__.'/vendor/autoload.php';

// $boards = BriHelper::parseFile(realpath('input-test.BRI'));
$boards = [];
for($b = 0; $b < 32; $b++){
    $deck = DeckFactory::createNormalDeck();
    $deck->shuffle();
    $board = new Board($b+1);
    foreach($board->getHands() as $hand){
        for($i = 0; $i < 13; $i++){
            $hand->addCard($deck->draw());
        }
    }
    $boards[] = $board;
}
// $diff = array_count_values($boards);
// foreach($boards as $k=>$board){
//     for($i = $k+1; $i < count($boards); $i++){
//         if($board == $boards[$i]) echo "Duplicate found on $k and $i\n";
//     }
// }
// $string = BriHelper::getStringFromBoards([$board]);
// $string = BriHelper::getStringFromBoards($boards);
// $single_str = BriHelper::getStringFromBoard($boards[0]);
// BriHelper::saveBoardsToFile($boards, __DIR__.'/outputtest.bri');

foreach($boards as $board){
    echo "Board ".$board->getBoardNumber().":\n$board\n\n";
}
// echo $string;
exit;