<?php
namespace nuffy\BriLib;

use Exception;
use nuffy\cards\{Deck, DeckException, DeckFactory};
use nuffy\cards\Card\CardFactory;
use nuffy\BriLib\Bridge\Board;
use nuffy\cards\Card\CardException;

class BriHelper
{
    /**
     * Parses .bri file into board objects
     * 
     * @param string $path 
     * @return Board[]
     * @throws Exception 
     * @throws CardException 
     * @throws DeckException 
     */
    public static function parseFile(string $path) : array
    {
        $input_file = file_get_contents($path);
        return self::parseString($input_file);
    }
    /**
     * Parses .bri string into board objects
     * 
     * @param string $bri_input 
     * @return Board[]
     * @throws Exception 
     * @throws CardException 
     * @throws DeckException 
     */
    public static function parseString(string $bri_input) : array
    {
        preg_match_all('/[\d]+/', $bri_input, $hand_matches);
        $boards = [];
        $b = 1;
        foreach($hand_matches[0] as $board_string){
            $board = new Board($b++);
            $deck = DeckFactory::createNormalDeck();
            $card_strings = str_split($board_string, 2);
            $card_pos = 0;
            foreach(['N', 'E', 'S'] as $hand_name){
                for($i = 0; $i < 13; $i++){
                    $board->getHand($hand_name)->addCard(
                        $deck->drawSpecific(
                            CardFactory::createFromString(BriValues::MAP[$card_strings[$card_pos]])
                        )
                    );
                    $card_pos++;
                }
            }
            $board->getWest()->addCards($deck->drawRemaining());
            $boards[] = $board;
        }
        return $boards;
    }
}