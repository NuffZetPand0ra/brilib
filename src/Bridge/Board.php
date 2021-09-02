<?php
namespace nuffy\BriLib\Bridge;

/**
 * Bridge board containing four hands of cards
 * 
 * @package nuffy\BriLib\Bridge
 */
class Board
{
    /**
     * Hands of the different players around the board
     * 
     * @var Hand[]
     */
    protected $hands = [
        "N"=>null,
        "S"=>null,
        "E"=>null,
        "W"=>null,
    ];

    /**
     * Creates a new board
     * 
     * @param int $board_number Board number, defaults to none (0)
     * @return void 
     */
    function __construct(protected int $board_number = 0)
    {
        foreach($this->hands as &$hand){
            $hand = new Hand();
        }
    }


    /**
     * Returns all hands as associative array
     * 
     * @return Hand[] 
     */
    public function getHands() : array
    {
        return $this->hands;
    }

    /**
     * Gets specified hand
     * 
     * @param string $hand_name Must be a hand name from Board::$hands
     * @return Hand 
     */
    public function getHand(string $hand_name) : Hand
    {
        if(!isset($this->hands[$hand_name])) throw new \Exception("No hand with name $hand_name.");
        
        return $this->hands[$hand_name];
    }

    /**
     * Returns the north hand
     * 
     * @return Hand 
     */
    public function getNorth() : Hand
    {
        return $this->getHand('N');
    }

    /**
     * Returns the south hand
     * 
     * @return Hand 
     */
    public function getSouth() : Hand
    {
        return $this->getHand('S');
    }

    /**
     * Returns the east hand
     * 
     * @return Hand 
     */
    public function getEast() : Hand
    {
        return $this->getHand('E');
    }

    /**
     * Returns the west hand
     * 
     * @return Hand 
     */
    public function getWest() : Hand
    {
        return $this->getHand('W');
    }

    /**
     * Gets board number of board
     * 
     * @return int 
     */
    public function getBoardNumber() : int
    {
        return $this->board_number;
    }

    public function __toString() : string
    {
        \ob_start();
        foreach($this->getHands() as $k=>$hand_source){
            $hand = clone($hand_source);
            $hand->sort();
            echo "$k: ";
            $previous_suit = 0;
            foreach($hand as $card){
                if($previous_suit !== $card->getSuit()->getValue()){
                    echo " | ";
                    $previous_suit = $card->getSuit()->getValue();
                }
                echo "$card ";
            }
            echo PHP_EOL;
        }
        return \ob_get_clean();
    }
}