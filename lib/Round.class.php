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

    /**
     * Compares provided cards from players
     * @param  Card   $card1 player1's card
     * @param  Card   $card2 player2's card
     */
    public function playCards($card1, $card2) {
        # check if either player is out of cards
        if ( $card1 == null && $card2 == null) {
            $this->round_complete = TRUE;
            return;
        } else if ( $card1 == null ) {
            # return player 2's card
            parent::addCard($card2);

            # declare player 2 winner of this round
            $this->round_winner = &$this->player2;
            $this->round_complete = TRUE;
            return;
        } else if ( $card2 == null ) {
            # return player 1's card
            parent::addCard($card1);

            # declare player 1 winner of this hand
            $this->round_winner = &$this->player1;
            $this->round_complete = TRUE;
            return;
        }


        parent::addCards( array($card1, $card2) );

        echo "player 1 plays: " . $card1->render() . "<br>";
        echo "player 2 plays: " . $card2->render() . "<br>";


        if ( $card1->greaterThan($card2) ) {
            echo "winner!<br>";
            echo "player 1 wins.";

            $this->round_winner = &$this->player1;
            $this->round_complete = TRUE;
        } else if ( $card1->equalTo($card2) ) {
            echo "WAR<br>";
        } else {
            echo "loser<br>";

            $this->round_winner = &$this->player2;
            $this->round_complete = TRUE;
        }
    }

    /**
     * Gives cards in cardset to the winner of this round
     * @return Player winner of the round
     */
    public function winnerTakesAll() {
        
        if ( $this->round_complete ) {
            $this->round_winner = array_merge($this->round_winner, $this->allCards() );
        }

        return FALSE;
    }
}