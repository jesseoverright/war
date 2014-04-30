<?php

abstract class CardSet {
    /**
     * Cards currently in this set
     * 
     * @var array of Cards
     */
    protected $cards = array();

    public function __construct($cards = array()) {
        $this->cards = $cards;
    }

    public function addCard(Card $card) {
        $this->cards[] = $card;
    }

    public function addCards(array $cards) {
        $this->cards = array_merge($this->cards, $cards);
    }

    public function allCards() {
        return $this->cards;
    }

    public function cardCount() {
        return count($this->cards);
    }

    public function drawFromTop() {
        return array_shift($this->cards);
    }

    public function shuffleCards() {

    }

    public function render() {
        foreach ($this->cards as $card) {
            $cards .= $card->render() . ", ";
        }
        $cards = substr($cards, 0, -2);
        return $cards;
    }
}