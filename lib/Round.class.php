<?php 

class Round extends CardSet {
    /**
     * Status of Round
     * @var boolean
     */
    protected $round_complete = FALSE;

    /**
     * Reference to player 1 Player object
     * @var Player
     */
    protected $player1;

    /**
     * Reference to player 2 Player object
     * @var Player
     */
    protected $player2;    

    /**
     * Reference to round winner Player object
     * @var Player
     */
    protected $round_winner;

    /**
     * Constructs round with current players. Player objects passed by reference.
     *         
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(&$player1, &$player2) {
        $this->player1 = &$player1;
        $this->player2 = &$player2;
    }

    /**
     * Retreives current status of the round
     * @return boolean round status
     */
    public function isComplete() {
        return $this->round_complete;
    }

    public function play() {
        while ($this->round_complete !== TRUE) {
            # check if either player is out of cards and end round
            if ( $this->player1->cardCount() == 0 && $this->player2->cardCount() == 0) {
                $this->round_complete = TRUE;
            } else if ( $this->player1->cardCount() == 0 ) {
                # declare player 2 winner of this round
                $this->round_winner = &$this->player2;
                $this->round_complete = TRUE;
            } else if ( $this->player2->cardCount() == 0 ) {
                # declare player 1 winner of this hand
                $this->round_winner = &$this->player1;
                $this->round_complete = TRUE;
            } else {
                $this->playCards($this->player1->drawFromTop(), $this->player2->drawFromTop() );
            }
        }

        $this->winnerTakesAll();

    }

    /**
     * Compares provided cards from players
     * @param  Card   $card1 player1's card
     * @param  Card   $card2 player2's card
     */
    private function playCards($card1, $card2) {
        parent::addCards( array($card1, $card2) );

        echo $this->player1->getName() . " plays: " . $card1->render() . "<br>";
        echo $this->player2->getName() . " plays: " . $card2->render() . "<br>";


        if ( $card1->greaterThan($card2) ) {
            echo $this->player1->getName() . " wins.<br>";

            $this->round_winner = &$this->player1;
            $this->round_complete = TRUE;
        } else if ( $card1->equalTo($card2) ) {
            echo "WAR!<br>";
        } else {
            echo $this->player1->getName() . " wins.<br>";

            $this->round_winner = &$this->player2;
            $this->round_complete = TRUE;
        }
    }

    /**
     * Gives cards in cardset to the winner of this round
     */
    private function winnerTakesAll() {
        
        if ( $this->round_complete ) {
            $this->round_winner->addCards( $this->allCards() );
        }

    }
}