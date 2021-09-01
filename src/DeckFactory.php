<?php
namespace nuffy\BriLib;

use nuffy\BriLib\Card\{Card, Rank, Suit};

class DeckFactory
{
    public static function createNormalDeck() : Deck
    {
        $deck = new Deck();
        foreach(Suit::SUITS as $suit){
            foreach(Rank::RANKS as $rank){
                $deck->addCard(new Card(Rank::create($rank), Suit::create($suit)));
            }
        }
        // var_dump($deck);
        // die();
        return $deck;
    }
}