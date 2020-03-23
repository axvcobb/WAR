<?php

require_once('Deck.php');

$rounds = 0;

$deck = new Deck();
$deck = $deck->createDeck();
$deck = Deck::shuffleDeck($deck);

$playerOneDeck = array_slice($deck, 0, 26);
$playerTwoDeck = array_slice($deck, 26);

while(count($playerOneDeck) > 0 && count($playerTwoDeck) > 0) {

  echo "\n\n" . $rounds . "\n";

  $playerOneDraw = Deck::drawCard($playerOneDeck);
  $playerTwoDraw = Deck::drawCard($playerTwoDeck);

  $playerOneCard = $playerOneDraw[0];
  $playerTwoCard = $playerTwoDraw[0];

  $playerOneDeck = $playerOneDraw[1];
  $playerTwoDeck = $playerTwoDraw[1];

  echo "Player One plays: " . $playerOneCard->getRankName() . " of " . $playerOneCard->getSuit() . "\n";
  echo "Player Two plays: " . $playerTwoCard->getRankName() . " of " . $playerTwoCard->getSuit() . "\n\n";

  if($playerOneCard->getRank() > $playerTwoCard->getRank()) {

    echo "Player One wins...this round...\n\n";
    array_push($playerOneDeck, $playerOneCard, $playerTwoCard);

  }elseif($playerTwoCard->getRank() > $playerOneCard->getRank()){

    echo "Player Two wins...this round...\n\n";
    array_push($playerTwoDeck, $playerTwoCard, $playerOneCard);

  }

  $upForGrabs = array();
  while($playerOneCard->getRank() == $playerTwoCard->getRank()){

    array_push($upForGrabs, $playerOneCard, $playerTwoCard);

    $playerOneCount = count($playerOneDeck);
    $playerTwoCount = count($playerTwoDeck);

    echo "WAR\n";

    if($playerOneCount < 4 && $playerOneCount != 0) {
      $playerOneSacrifice = array_splice($playerOneDeck, 0, count($playerOneDeck)-1);
      $playerTwoSacrifice = array_splice($playerTwoDeck, 0, 3);
    }elseif($playerTwoCount < 4 && $playerTwoCount != 0){
      $playerOneSacrifice = array_splice($playerOneDeck, 0, 3);
      $playerTwoSacrifice = array_splice($playerTwoDeck, 0, count($playerTwoDeck)-1);
    }elseif($playerOneCount >= 4 && $playerTwoCount >= 4){
      $playerOneSacrifice = array_splice($playerOneDeck, 0, 3);
      $playerTwoSacrifice = array_splice($playerTwoDeck, 0, 3);
    }else{
      break 2;
    }

    $playerOneDraw = Deck::drawCard($playerOneDeck);
    $playerTwoDraw = Deck::drawCard($playerTwoDeck);

    $playerOneCard = $playerOneDraw[0];
    $playerTwoCard = $playerTwoDraw[0];

    $playerOneDeck = $playerOneDraw[1];
    $playerTwoDeck = $playerTwoDraw[1];

    $upForGrabs = array_merge($upForGrabs, $playerOneSacrifice, $playerTwoSacrifice);

    echo "1...2...3...WAR \n";
    echo "Player One's Champion is the " . $playerOneCard->getRankName() . " of " . $playerOneCard->getSuit() . "\n";
    echo "Player Two's Champion is the " . $playerTwoCard->getRankName() . " of " . $playerTwoCard->getSuit() . "\n";

    if($playerOneCard->getRank() > $playerTwoCard->getRank()){
      $playerOneDeck = array_merge($playerOneDeck, $upForGrabs);
      array_push($playerOneDeck, $playerOneCard, $playerTwoCard);
      echo "Player One wins this round of WAR!\n";
    }elseif($playerOneCard->getRank() < $playerTwoCard->getRank()){
      $playerTwoDeck = array_merge($playerTwoDeck, $upForGrabs);
      array_push($playerTwoDeck, $playerTwoCard, $playerOneCard);
      echo "Player Two wins this round of WAR!\n";
    }

  }

  $rounds++;

}

echo (count($playerOneDeck) == 0) ? "\nPlayer 2 wins!"
                           : "\nPlayer 1 wins!";

/* $drawCard = Deck::drawCard($deck);
$card = $drawCard[0];
$deck = $drawCard[1];
echo $card->getRank() . " " . $card->getSuit() . "\n\n";
foreach ($deck as $card){
    echo $card->getRank() . " " . $card->getSuit() . "\n";
} */

?>
