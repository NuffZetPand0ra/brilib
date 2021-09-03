<?php
namespace nuffy\BriLib\Bridge;

use nuffy\cards\DeckFactory;

class BoardFactory
{
    public static function generateRandomBoard() : Board
    {
        $boards = self::generateRandomBoardCollection(1);
        return $boards[0];
    }
    public static function generateRandomBoardCollection(int $board_count) : BoardCollection
    {
        $boards = new BoardCollection();
        $deck = DeckFactory::createNormalDeck();
        for($b = 0; $b < $board_count; $b++){
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
        return $boards;
    }
}