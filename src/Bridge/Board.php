<?php
namespace nuffy\BriLib\Bridge;

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
     * @return void 
     */
    function __construct()
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