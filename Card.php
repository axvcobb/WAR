<?php

class Card {

  public $suit;
  public $rank;

  function __construct($suit, $rank){
    $this->suit = $suit;
    $this->rank = $rank;
  }

  function getSuit(){
    switch ($this->suit) {
      case 1:
        return "Hearts";
        break;

      case 2:
        return "Diamonds";
        break;

      case 3:
        return "Spades";
        break;

      case 4:
        return "Clubs";
        break;

      default:
        throw new \Exception("Invalid Suit", 1);
        break;
    }
  }

  function getRank(){
    return ($this->rank == 1) ? $this->rank = 13
                              : $this->rank;
  }

  function getRankName(){
    switch ($this->rank) {
      case 1:
        return "Ace";
        break;

      case 11:
        return "Jack";
        break;

      case 12:
        return "Queen";
        break;

      case 13:
        return "King";
        break;

      default:
        return $this->rank;
        break;
    }
  }
}

?>
