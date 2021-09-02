<?php
namespace nuffy\BriLib;

use nuffy\BriLib\Card\{Card, Rank, Suit};

/** @package nuffy\BriLib */
class DeckFactory
{
    /**
     * Creates a normal 52 card deck with four suits of thirteen cards
     * 
     * @return Deck Unshuffled deck of 52 cards
     */
    public static function createNormalDeck() : Deck
    {
        $deck = new Deck();
        foreach(Suit::SUITS as $suit){
            foreach(Rank::RANKS as $rank){
                $deck->addCard(new Card(Rank::create($rank), Suit::create($suit)));
            }
        }
        return $deck;
    }
}