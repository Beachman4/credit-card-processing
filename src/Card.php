<?php

namespace Finance;

class Card
{
    public $cardNumber;

    public $name;

    public $balance = 0;

    public $limit;

    public $changes = [];

    public $error = false;

    /**
     * Card constructor.
     * @param $cardNumber
     * @param $name
     * @param $amount
     * @param $changes
     */
    public function __construct($cardNumber, $name, $amount)
    {
        $this->cardNumber = $cardNumber;
        $this->name = $name;
        $this->limit = $amount;
        $this->luhnCheck();
    }

    /**
     * @param $amount
     * Credit the card(subtract from balance) given amount
     */
    public function credit($amount)
    {
        if (!$this->error) {
            $array = [
                'action' => 'credit',
                'status' => 'success',
                'from' => $this->balance,
                'to' => $this->balance - $amount
            ];
            array_push($this->changes, $array);
            $this->balance -= $amount;
        }
    }

    /**
     * @param $amount
     * Increase Balance if it passes the check
     */
    public function charge($amount)
    {
        if (!$this->error) {
            if (($this->balance + $amount) > $this->limit) {
                $array = [
                    'action' => 'charge',
                    'status' => 'failure',
                    'reason' => 'Not enough available credit'
                ];
                array_push($this->changes, $array);
            } else {
                $array = [
                    'action' => 'charge',
                    'status' => 'success',
                    'from' => $this->balance,
                    'to' => $this->balance + $amount
                ];
                array_push($this->changes, $array);
                $this->balance += $amount;
            }
        }
    }

    /**
     * Check the validity of the credit card number
     * @return bool
     */
    public function luhnCheck()
    {
        $card = str_split(strrev($this->cardNumber));
        $check = "";
        foreach($card as $key => $value) {
            $check .= $key % 2 !== 0 ? $value * 2 : $value;
        }
        // so bulky but had to do it this way unless I wanted to put logic in the constructor
        if (array_sum(str_split($check)) % 10 === 0) {
            return true;
        }
        $this->error = true;
        return false;
    }
}
