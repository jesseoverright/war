<?php

interface Game {
    /**
     * Include settings array when game is instantiated
     * @param  array $settings
     */
    public function __construct( $settings );

    public function play();
}