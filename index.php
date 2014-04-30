<?php

include_once( dirname( __FILE__ ) . '/lib/Card.class.php' );
include_once( dirname( __FILE__ ) . '/lib/Suit.class.php' );
include_once( dirname( __FILE__ ) . '/lib/SuitedCard.class.php' );
include_once( dirname( __FILE__ ) . '/lib/CardSet.class.php' );

include_once( dirname( __FILE__ ) . '/lib/Heart.class.php' );
include_once( dirname( __FILE__ ) . '/lib/Diamond.class.php' );
include_once( dirname( __FILE__ ) . '/lib/Spade.class.php' );
include_once( dirname( __FILE__ ) . '/lib/Club.class.php' );

include_once( dirname( __FILE__ ) . '/lib/Hand.class.php' );
include_once( dirname( __FILE__ ) . '/lib/Player.class.php' );

include_once( dirname( __FILE__ ) . '/lib/Deck.class.php' );
include_once( dirname( __FILE__ ) . '/lib/Game.class.php' );
include_once( dirname( __FILE__ ) . '/lib/Round.class.php' );

include_once( dirname( __FILE__ ) . '/lib/War.class.php' );

$player_details = array('name' => "Jesse");

$settings = array('player1' => $player_details);

$game = new War($settings);

$game->play();
