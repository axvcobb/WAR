<?php

require_once('Card.php');

class Deck{

  function createDeck() {

    $deck = array();

    for($i = 1; $i < 5; $i++){

      for($j = 1; $j < 14; $j++){

        $card = new Card($i, $j);
        array_push($deck, $card);

      }

    }

    return $deck;

  }

  static function shuffleDeck($deck) {

    shuffle($deck);

    return $deck;

  }

  static function drawCard($deck) {

    $card = array_shift($deck);

    return array($card, $deck);

  }


}

?>
