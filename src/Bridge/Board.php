<?php
namespace nuffy\BriLib\Bridge;

class Board
{
    protected $hands = [
        "N"=>null,
        "S"=>null,
        "E"=>null,
        "W"=>null,
    ];

    function __construct()
    {
        foreach($this->hands as &$hand){
            $hand = new Hand();
        }
    }

    public function getHands() : array
    {
        return $this->hands;
    }

    public function getHand(string $hand_name) : Hand
    {
        return $this->hands[$hand_name];
    }

    public function getNorth() : Hand
    {
        return $this->hands['N'];
    }

    public function getSouth() : Hand
    {
        return $this->hands['S'];
    }

    public function getEast() : Hand
    {
        return $this->hands['E'];
    }

    public function getWest() : Hand
    {
        return $this->hands['W'];
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