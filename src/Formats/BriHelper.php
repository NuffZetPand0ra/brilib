<?php
namespace nuffy\BriLib\Formats;

use Exception;
use nuffy\cards\{CardCollection, Deck, DeckException, DeckFactory};
use nuffy\cards\Card\CardFactory;
use nuffy\BriLib\Bridge\{Board, BoardCollection};
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

    /**
     * 
     * @param BoardCollection $boards 
     * @param string $outuput_dest 
     * @return void 
     */
    public static function saveBoardsToFile(BoardCollection $boards, string $outuput_dest) : void
    {
        $file = fopen($outuput_dest, 'w+');
        fwrite($file, self::getStringFromBoards($boards));
    }

    public static function getStringFromBoards(BoardCollection $boards) : string
    {
        $str = "";
        foreach($boards as $board){
            $str .= self::getStringFromBoard($board);
        }
        return $str;
    }

    public static function getStringFromBoard(Board $board) : string
    {
        $card_strings = [];
        foreach(['N', 'E', 'S'] as $hand_name){
            $hand_strings = [];
            foreach($board->getHand($hand_name)->getRemainingCards() as $card){
                $hand_strings[] = (string)array_search($card->getRank().$card->getSuit(), BriValues::MAP);
            }
            sort($hand_strings);
            $card_strings = array_merge($card_strings, $hand_strings);
        }
        return implode('', $card_strings).str_repeat(' ', 32).str_repeat("\000", 18);
    }
}