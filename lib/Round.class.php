<?php 

class Round extends CardSet {

    protected $player1_card;
    protected $player2_card;

    public function __construct(Card $card1, Card $card2) {
        
        $this->player1_card = $card1;
        $this->player2_card = $card2;

        # add cards to cardset
        parent::__construct( array($card1, $card2) );
    }

    public function play() {

        echo "player 1 plays: " . $this->player1_card->render() . "<br>";
        echo "player 2 plays: " . $this->player2_card->render() . "<br>";


        if ( $this->player1_card->greaterThan($this->player2_card) ) {
            echo "winner!<br>";
            echo "player 1 wins:" . $this->allCards();
        } else if ( $this->player1_card->equalTo($this->player2_card) ) {
            echo "WAR<br>";
        } else {
            echo "loser<br>";
        }
    }
}