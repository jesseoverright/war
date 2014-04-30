<?php

class War implements Game {
    /**
     * Player 1 Player object
     * @var Player
     */
    private $player1;

    /**
     * Player 2 Player object
     * @var Player
     */
    private $player2;

    /**
     * This game's deck of cards
     * @var Deck
     */
    private $deck;

    /**
     * Constructor
     * @param array $settings declares player details
     */
    public function __construct( $settings ) {
        $deck = new Deck();

        $this->player1 = new Player($settings['player1']['name']);
        $this->player2 = new Player($settings['player2']['name']);

        while ( $deck->cardCount() > 0 ) {
            $this->player1->addCard( $deck->drawFromTop() );
            $this->player2->addCard( $deck->drawFromTop() );
        }
    }

    /**
     * Play the game of war, by playing rounds of the game until one player forfeits
     */
    public function play() {
        echo $this->player1->render();

        echo $this->player2->render();

        do {
            $round = new Round($this->player1, $this->player2);

            $round->play(); 

            echo $this->player1->render();

            echo $this->player2->render();
        } while ($round->status() != "FORFEITED" && $round->status() != "DRAW") ;

        echo $this->declareWinner();
    }

    /**
     * Declare the winner of this game
     * @return string winner!
     */
    private function declareWinner() {
        # loser may have one card remaining if they had to forfeit a war.
        if ( $this->player1->cardCount() <= 1 ) {
            $winner = $this->player2->getName();
        } else if ($this->player2->cardCount() <= 1 ) {
            $winner = $this->player1->getName();
        }

        return "Congratulations $winner, you have won the war!";
    }
}