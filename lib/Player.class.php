<?php

class Player extends CardSet implements Hand{
    protected $name;

    public function __construct( $name, $cards = array() ) {
        $this->name = $name;
        parent::__construct( $cards );
    }

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