<?php
namespace Finance;

class Database
{
    private $cards = [];

    /**
     * @param $array
     * Add Card, instantiate the Card Class and add to cards array
     */
    public function add($array)
    {
        $amount = intval(str_replace("$", "", $array[3]));
        $card = new Card($array[2], $array[1], $amount);
        array_push($this->cards, $card);
    }

    /**
     * @param $array
     * Filter the array and get the card specified and then call the method on the card object to charge the card
     */
    public function charge($array)
    {
        $cards = array_filter($this->cards, function($card) use($array) {
            return $array[1] == $card->name;
        });
        if (count($cards) != 0) {
            $amount = intval(str_replace("$", "", $array[2]));
            //why is this even needed
            $card = max($cards);
            $card->charge($amount);
        }
    }

    /**
     * @param $array
     * Filter the array to find the specific card and then call the method on the card object to credit the card.
     */
    public function credit($array)
    {
        $cards = array_filter($this->cards, function($card) use($array) {
            return $array[1] == $card->name;
        });
        if (count($cards) != 0) {
            //why is this even needed
            $card = max($cards);
            $amount = intval(str_replace("$", "", $array[2]));
            $card->credit($amount);
        }
    }

    /**
     * @param $array
     * Remove the card from the array
     */
    public function remove($array)
    {
        for($i = 0; $i < count($this->cards); $i++) {
            $card = $this->cards[$i];
            if ($card->name == $array[1]) {
                unset($this->cards[$i]);
                $this->cards = array_values($this->cards);
            }
        }
    }

    /**
     * Get the cards array
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }
}