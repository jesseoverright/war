<?php

interface Card {
    /**
     * Retreive the textual representation of this value
     * @return string
     */
    public function getValue();

    /**
     * Compares values of two cards
     * @param  Card   $otherCard second card
     * @return boolean        Boolean results of comparing Card to other card
     */
    public function greaterThan(Card $otherCard);

    /**
     * Retreive boolean if card is equal to another
     * @param  Card   $otherCard second card
     * @return boolean        Boolean results for if this card is equal to other card
     */
    public function equalTo(Card $otherCard);


    /**
     * Renders the individual card
     * @return string
     */
    public function render();
}