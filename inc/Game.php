<?php

class Game
{
    private $phraseObj;
    private $lives = 5;

    public function __construct(Phrase $phraseObj)
    {
        $this->phraseObj = $phraseObj;
    }

    // Display the keyboard
    public function displayKeyboard()
    {
        $keyRow1 = array("q", "w", "e", "r", "t", "y", "u", "i", "o", "p");
        $keyRow2 = array("a", "s", "d", "f", "g", "h", "j", "k", "l");
        $keyRow3 = array("z", "x", "c", "v", "b", "n", "m");

        // Display first key row
        $htmlKeyRow1 = "<div class='keyrow'>";
        foreach($keyRow1 as $letter) {
            $htmlKeyRow1 .= $this->handleLetterKey($letter);
        }
        $htmlKeyRow1 .= "</div>";

        // Display second key row
        $htmlKeyRow2 = "<div class='keyrow'>";
        foreach($keyRow2 as $letter) {
            $htmlKeyRow2 .= $this->handleLetterKey($letter);
        }
        $htmlKeyRow2 .= "</div>";

        // Display third key row
        $htmlKeyRow3 = "<div class='keyrow'>";
        foreach($keyRow3 as $letter) {
            $htmlKeyRow3 .= $this->handleLetterKey($letter);
        }
        $htmlKeyRow3 .= "</div>";

        // Build the keyboard as a form and add each key row to it
        $htmlKeyboard = "<form action='play.php' method='post'>";
        $htmlKeyboard .= "<div id='qwerty' class='section'>";
        $htmlKeyboard .= $htmlKeyRow1;
        $htmlKeyboard .= $htmlKeyRow2;
        $htmlKeyboard .= $htmlKeyRow3;
        $htmlKeyboard .= "</div>";
        $htmlKeyboard .= "</form>";

        return $htmlKeyboard;
    }

    // Display score (number of lives)
    public function displayScore()
    {
        $htmlScoreBoard = "<div id='scoreboard' class='section'>";
        $htmlScoreBoard .= "<ol>";
        // Loop through the number of lives (starting from 1) and display hearts
        for($x = 1; $x <= $this->lives; $x++) {
            $htmlScoreBoard .= "<li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>";
        }
        $htmlScoreBoard .= "</ol>";
        $htmlScoreBoard .= "</div>";

        return $htmlScoreBoard;
    }

    // Handle the key to display
    public function handleLetterKey($letter)
    {
        $selected = $this->phraseObj->selected;

        if(!in_array($letter, $selected)) {
            $letterElement = "<button class='key' name='key' value='" . $letter . "'>$letter</button>";
        } else {
            if($this->phraseObj->checkLetter($letter)) {
                $letterElement = "<button class='key correct' style='background-color: green' disabled>$letter</button>";
            } else {
                $letterElement = "<button class='key incorrect' style='background-color: red' disabled>$letter</button>";
            }
        }

        return $letterElement;
    }
    
    
    
    

    // // Checks to see if the player has selected all of the letters
    // public function checkForWin()
    // {
    //     var_dump($_SESSION['selectedLetters']);
    // }

    // // Checks to see if the player has guessed too many wrong letters
    // public function checkForLose()
    // {

    // }

    // // Displays one message if the player wins and another message if they lose. It returns false if the game has not been won or lost
    // public function gameOver()
    // {

    //     $htmlGameOver = "<h1 id='game-over-message'>The phrase was: '" . $this->phrase->currentPhrase . "'. Better luck next time!</h1>";

    //     return $htmlGameOver;
    // }

}