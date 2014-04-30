<?php

class Diamond extends SuitedCard {
    const SUIT = 'Diamond';

    /**
     * Constructor
     * @param int or string $value the value of this card
     */
    public function __construct($value) {
        parent::__construct($value, self::SUIT);
    }
}