<?php
namespace nuffy\BriLib;

use nuffy\BriLib\Card\{Card, Suit, Rank};

class Deck implements \Iterator
{
    protected $drawn_cards = [];
    protected $remaining_cards = [];

    public function __construct()
    {
    }

    public function addCard(Card $card) : self
    {
        $this->remaining_cards[] = $card;

        return $this;
    }

    public function addCards(array $cards) : self
    {
        foreach($cards as $card){
            $this->addCard($card);
        }

        return $this;
    }

    public function shuffle(bool $only_remaining_cards = true) : self
    {
        if(!$only_remaining_cards) $this->rewind();

        \shuffle($this->remaining_cards);
        $this->rewind();

        return $this;
    }

    public function draw(int $position = 0) : Card
    {
        if(count($this->remaining_cards) === 0) throw new DeckException('There are no cards to draw.');

        if($position == 0) return $this->drawn_cards[] = array_shift($this->remaining_cards);

        $return = $this->remaining_cards[$position];
        $this->drawn_cards[] = $this->remaining_cards[$position];
        unset($this->remaining_cards[$position]);
        $this->remaining_cards = array_values($this->remaining_cards);
        return $return;
    }

    public function getRemainingCards() : array
    {
        return $this->remaining_cards;
    }

    public function getDrawnCards() : array
    {
        return $this->drawn_cards;
    }

    public function drawRemaining() : array
    {
        $remaining_cards = $this->remaining_cards;
        $this->drawn_cards = array_merge($this->drawn_cards, $this->remaining_cards);
        $this->remaining_cards = [];
        return $remaining_cards;
    }

    public function flushDraws() : self
    {
        $this->drawn_cards = [];
        
        return $this;
    }

    public function search(Card $card_to_find) : ?int
    {
        $cards_to_search = array_values($this->remaining_cards);
        foreach($cards_to_search as $i=>$card_in_deck){
            if($card_in_deck == $card_to_find) return $i;
        }

        return null;
    }

    public function sort(?callable $sort = null) : self
    {
        if($sort){
            $sort($this->remaining_cards);
        }else{
            usort($this->remaining_cards, function(Card $a, Card $b){
                if($a->getSuit()->getValue() == $b->getSuit()->getValue()){
                    return $a->getRank()->getValue() <=> $b->getRank()->getValue();
                }
                return $a->getSuit()->getValue() <=> $b->getSuit()->getValue();
            });
        }
        return $this;
    }

    public function count() : int
    {
        return count($this->remaining_cards);
    }



    /**
     * Implementation of Traversible
     */

    public function current() : Card
    {
        return $this->remaining_cards[0];
    }

    public function key()
    {
        return count($this->drawn_cards);
    }

    public function next()
    {
        $this->draw();
    }

    public function rewind()
    {
        $this->remaining_cards = array_merge($this->drawn_cards, $this->remaining_cards);
        $this->flushDraws();
    }

    public function valid() : bool
    {
        return isset($this->remaining_cards[0]);
    }
}