<?php

abstract class CardSet {
    /**
     * Cards currently in this set
     *
     * @var array of Cards
     */
    protected $cards = array();

    /**
     * Constructor
     * @param array $cards Card
     */
    public function __construct($cards = array()) {
        $this->cards = $cards;
    }

    /**
     * Adds a card to the CardSet
     * @param Card $card
     */
    public function addCard(Card $card) {
        $this->cards[] = $card;
    }

    /**
     * Adds an array of cards to the CardSet
     * @param array $cards Cards
     */
    public function addCards(array $cards) {
        $this->cards = array_merge($this->cards, $cards);
    }

    /**
     * Returns all cards in this Card Set
     * @return array of Cards
     */
    public function allCards() {
        return $this->cards;
    }

    /**
     * Returns the current card count of this set
     * @return int
     */
    public function cardCount() {
        return count($this->cards);
    }

    /**
     * Renders the current cardset in text format
     * @return string a list of the current cards in cardset
     */
    public function render() {
        $cards = "";
        foreach ($this->cards as $card) {
            $cards .= $card->render() . ", ";
        }
        $cards = substr($cards, 0, -2);
        return $cards;
    }
}
