<?php

class Deck extends CardSet implements Hand {
    /**
     * Constructor
     *
     * creates a shuffled, valid deck of cards
     */
    function __construct() {
        foreach (SuitedCard::$possible_values as $value) {
            $this->addCard( new Heart($value) );
            $this->addCard( new Diamond($value) );
            $this->addCard( new Club($value) );
            $this->addCard( new Spade($value) );
        }

        $this->shuffleCards();
    }

    /**
     * Returns the top card from the Deck
     */
    public function drawFromTop() {
        return array_shift($this->cards);
    }

    /**
     * Shuffles all cards in cardSet
     */
    public function shuffleCards() {
        shuffle($this->cards);
    }
}