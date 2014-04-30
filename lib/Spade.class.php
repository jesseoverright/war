<?php

class Spade extends SuitedCard {
    const SUIT = 'Spade';

    /**
     * Constructor
     * @param int or string $value the value of this card
     */
    public function __construct($value) {
        parent::__construct($value, self::SUIT);
    }
}