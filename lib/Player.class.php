<?php

class Player extends CardSet {
    protected $name;

    public function __construct( $name, $cards = array() ) {
        $this->name = $name;
        $this->cards = $cards;
    }

    public function getName() {
        return $this->name;
    }

    public function render() {
        $render =  $this->name . "'s hand: ";

        $render .= parent::render() . "<br>";

        return $render;
    }
    
}