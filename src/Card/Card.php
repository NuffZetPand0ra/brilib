<?php
namespace nuffy\BriLib\Card;

class Card
{
    protected $rank;
    protected $suit;

    public function __construct(Rank $rank, Suit $suit)
    {
        $this->rank = $rank;
        $this->suit = $suit;
    }

    public function __toString() : string
    {
        return $this->rank.$this->suit->getSymbol();
    }

    public function getSuit() : Suit
    {
        return $this->suit;
    }

    public function getRank() : Rank
    {
        return $this->rank;
    }
}