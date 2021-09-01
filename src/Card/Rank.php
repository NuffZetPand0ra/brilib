<?php
namespace nuffy\BriLib\Card;

class Rank
{
    protected $rank;

    public const RANKS = [
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
        "T",
        "J",
        "Q",
        "K",
        "A",
    ];

    public function __construct(string $rank)
    {
        $rank = strtoupper($rank);
        if(!in_array($rank, self::RANKS)) throw new CardException("$rank is not a valid rank");
        $this->rank = $rank;
    }

    public function __toString() : string
    {
        return $this->getString();
    }

    public static function create(string $rank) : self
    {
        return new self($rank);
    }

    public function getString() : string
    {
        return $this->rank;
    }

    public function getValue() : int
    {
        return array_search($this->rank, self::RANKS);
    }
}