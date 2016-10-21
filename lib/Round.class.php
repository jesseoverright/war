<?php

class Round extends CardSet {
    const INCOMPLETE = 1;
    const WAR = 2;
    const COMPLETE = 4;
    const FORFEITED = 8;
    const DRAW = 16;

    /**
     * Status of Round
     * @var boolean
     */
    protected $round_status = self::INCOMPLETE;

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
     * @return string round_status
     */
    public function status() {
        switch ($this->round_status) {
            case self::WAR:
                return 'WAR';
                break;
            case self::COMPLETE:
                return 'COMPLETE';
                break;
            case self::FORFEITED:
                return 'FORFEITED';
                break;
            case self::DRAW:
                return 'DRAW';
                break;
            case self::INCOMPLETE:
            default:
                return 'INCOMPLETE';
                break;
        }
    }

    public function play() {
        $minimum_required_cards = 1;
        while ($this->round_status === self::INCOMPLETE || $this->round_status === self::WAR) {
            # check if either player is out of cards and end round
            if ($this->round_status == self::WAR ) $minimum_required_cards = 2;
            if ( $this->player1->cardCount() < $minimum_required_cards && $this->player2->cardCount() < $minimum_required_cards) {
                $this->round_status = self::DRAW;
            } else if ( $this->player1->cardCount() < $minimum_required_cards ) {
                echo $this->player1->getName() . " forfeits this round.\n";
                # declare player 2 winner of this round
                $this->round_winner = &$this->player2;
                $this->round_status = self::FORFEITED;
            } else if ( $this->player2->cardCount() < $minimum_required_cards ) {
                echo $this->player2->getName() . " forfeits this round.\n";

                # declare player 1 winner of this hand
                $this->round_winner = &$this->player1;
                $this->round_status = self::FORFEITED;
            } else {
                # in war, add top card
                if ($this->round_status == self::WAR) {
                    parent::addCards( array( $this->player1->drawFromTop(), $this->player2->drawFromTop() ) );
                    echo "Both players add a card\n";
                }
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

        echo $this->player1->getName() . " plays: " . $card1->render() . "\n";
        echo $this->player2->getName() . " plays: " . $card2->render() . "\n";


        if ( $card1->greaterThan($card2) ) {
            $this->round_winner = &$this->player1;
            $this->round_status = self::COMPLETE;
        } else if ( $card1->equalTo($card2) ) {
            echo "WAR!\n";
            $this->round_status = self::WAR;
        } else {
            $this->round_winner = &$this->player2;
            $this->round_status = self::COMPLETE;
        }

        if ($this->round_status === self::COMPLETE) {
            echo $this->round_winner->getName() . " wins this round. " . $this->round_winner->getName() . " collects " . $this->render() . "\n";
        }
    }

    /**
     * Gives cards in cardset to the winner of this round
     */
    private function winnerTakesAll() {

        if ( $this->round_status == self::COMPLETE || $this->round_status == self::FORFEITED) {
            $this->round_winner->addCards( $this->allCards() );
        }

    }
}
