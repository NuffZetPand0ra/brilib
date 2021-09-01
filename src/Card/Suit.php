<?php
namespace nuffy\BriLib\Card;

class Suit
{
    protected $suit;

    public const SUITS = [
        "C",
        "D",
        "H",
        "S"
    ];

    protected const SYMBOLS = [
        "C"=>"♧",
        "D"=>"♢",
        "H"=>"♡",
        "S"=>"♤"
    ];

    public function __construct(string $suit)
    {
        $suit = strtoupper($suit);
        if(!in_array($suit, self::SUITS)) throw new CardException("$suit is not a valid suit");
        $this->suit = $suit;
    }

    public function __toString() : string
    {
        return $this->getString();
    }

    public static function create(string $suit) : self
    {
        return new self($suit);
    }

    public function getString() : string
    {
        return $this->suit;
    }

    public function getValue() : int
    {
        return array_search($this->suit, self::SUITS);
    }

    public function getSymbol() : string
    {
        return self::SYMBOLS[$this->suit];
    }
}