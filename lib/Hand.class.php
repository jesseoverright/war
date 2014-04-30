<?php

interface Hand {
    /**
     * Returns the top card from the Hand
     */
    public function drawFromTop();
}