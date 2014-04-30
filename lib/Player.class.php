<?php

class Player extends CardSet implements Hand{
    /**
     * The name of this player
     * @var string
     */
    protected $name;

    /**
     * Constructor
     * @param string $name  name of player
     * @param array  $cards cards
     */
    public function __construct( $name = 'Computer', $cards = array() ) {
        if ( empty( $name ) ) $name = 'Computer';
        $this->name = $name;
        parent::__construct( $cards );
    }

    /**
     * Retrieves player name
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Returns the top card from the Hand, removing it from the cardset
     * @return Card top card
     */
    public function drawFromTop() {
        return array_shift($this->cards);
    }

    public function render() {
        $render =  $this->name . "'s hand: ";

        $render .= parent::render() . "<br>";

        return $render;
    }
    
}