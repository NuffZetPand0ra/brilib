<?php
namespace nuffy\BriLib;

use nuffy\BriLib\Card\{Card, Rank, CardFactory};
use nuffy\BriLib\Bridge\Board;

require_once __DIR__.'/vendor/autoload.php';

$deck = DeckFactory::createNormalDeck();

$my_card = $deck->draw(
    $deck->search(
        CardFactory::createFromString('QH')
    )
);
$board = new Board();
$deck->shuffle();
for($i = 0; $i < 13; $i++){
    foreach($board->getHands() as $hand){
        $hand->addCard($deck->draw());
    }
}
echo $board;
// foreach($board->getHands() as $k=>$hand){
//     $hand->sort();
//     echo "$k: ";
//     $previous_suit = 0;
//     foreach($hand as $card){
//         if($previous_suit !== $card->getSuit()->getValue()){
//             echo " | ";
//             $previous_suit = $card->getSuit()->getValue();
//         }
//         echo "$card ";
//     }
//     echo PHP_EOL;
// }
// var_dump($board);
// exit;


$input_file = file_get_contents('input-test.BRI');
preg_match_all('/[\d]+/', $input_file, $hand_matches);
$boards = [];
foreach($hand_matches[0] as $board_string){
    $board = new Board();
    $deck = DeckFactory::createNormalDeck();
    $card_strings = str_split($board_string, 2);
    $card_pos = 0;
    foreach(['N', 'E', 'S'] as $hand_name){
        for($i = 0; $i < 13; $i++){
            // $card_to_find = CardFactory::createFromString(BriValues::MAP[$card_strings[$card_pos]]);
            $board->getHand($hand_name)->addCard(
                $deck->draw(
                    $deck->search(CardFactory::createFromString(BriValues::MAP[$card_strings[$card_pos]]))
                )
            );
            $card_pos++;
        }
    }
    $board->getWest()->addCards($deck->drawRemaining());
    $boards[] = $board;
    // var_dump($deck, (string)$board);
    // echo $board;
    // exit;
}
$b = 1;
foreach($boards as $board){
    echo "Board $b:\n$board\n\n";
    $b++;
}
// var_dump($hand_matches);
exit;