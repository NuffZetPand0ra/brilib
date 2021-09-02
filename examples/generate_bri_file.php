<?php
require_once __DIR__.'/../vendor/autoload.php';

use nuffy\cards\DeckFactory;
use nuffy\BriLib\Bridge\{Board, BoardCollection};
use nuffy\BriLib\Formats\BriHelper;

$boards = new BoardCollection();
$deck = DeckFactory::createNormalDeck();
for($b = 0; $b < 32; $b++){
    $deck->shuffle(false);
    $board = new Board($b+1);
    for($i = 0; $i < 13; $i++){ 
        /* Deal 13 cards to each player, 
           as you normally would. */
        foreach($board->getHands() as $hand){
            $hand->addCard($deck->draw());
        }
    }
    $boards->add($board);
}
BriHelper::saveBoardsToFile($boards, 'outputfile.bri');
