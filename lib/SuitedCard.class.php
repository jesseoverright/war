<?php

abstract class SuitedCard implements Card, Suit {
    /**
     * a static array of allowable cards
     * @var array
     */
    public static $possible_values = array('2','3','4','5','6','7','8','9','10','J','Q','K','A');

    /**
     * The Suit
     * @var string
     */
    private $suit;

    /**
     * The numerical value of this card and key value of the possible value
     * @var int
     */
    private $value;

    /**
     * Constructor
     * @param string or int $value
     * @param string $suit  suit of this card
     */
    public function __construct( $value, $suit ) {

        // allow for integer or string values to be passed
        if ( is_int($value) ) {
            if ( array_key_exists($value, SuitedCard::$possible_values) ) $this->value = $value;
            else $this->value = FALSE;
        } else {
            $this->value = array_search($value, SuitedCard::$possible_values);
        }

        if ( $this->value === FALSE ) throw new Exception('This is not a legal card value.');

        $this->suit = $suit;
    }

    /**
     * Retreive the textual representation of this suit
     * @return string
     */
    public function getSuit() {
        return $this->suit;
    }

    /**
     * Retreive the textual representation of this value
     * @return string
     */
    public function getValue() {
        return SuitedCard::$possible_values[$this->value];
    }

    /**
     * Compares values of two cards
     * @param  Card   $otherCard second card
     * @return boolean        Boolean results of comparing Card to other card
     */
    public function greaterThan( Card $otherCard ) {
        if ( $this->value > $otherCard->value ) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Retreive boolean if card is equal to another
     * @param  Card   $otherCard second card
     * @return boolean        Boolean results for if this card is equal to other card
     */
    public function equalTo(Card $otherCard) {
        if ( $this->value == array_search($otherCard->getValue(), SuitedCard::$possible_values) ) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Renders the individual card
     * @return string
     */
    public function render() {
        return $this->getValue() . ' ' . $this->getSuit();
    }
}
