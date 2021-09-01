<?php
namespace nuffy\BriLib\Card;

class CardFactory
{
    public static function createFromString(string $card) : Card
    {
        try{
            $chars = str_split($card);
            $rank = new Rank($chars[0]);
            $suit = new Suit($chars[1]);
        }catch(\Exception $e){
            throw new CardException("Error while creating card: ".$e->getMessage(),0,$e);
        }
        return new Card($rank, $suit);
    }
}