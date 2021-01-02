<?php

class Game
{
    private $phrase;
    private $lives = 5;

    public function __construct(Phrase $phrase)
    {
        $this->phrase = $phrase;
    }

    // Checks to see if the player has selected all of the letters
    public function checkForWin()
    {
        var_dump($_SESSION['selectedLetters']);
    }

    // Checks to see if the player has guessed too many wrong letters
    public function checkForLose()
    {

    }

    // Displays one message if the player wins and another message if they lose. It returns false if the game has not been won or lost
    public function gameOver()
    {

        $htmlGameOver = "<h1 id='game-over-message'>The phrase was: '" . $this->phrase->currentPhrase . "'. Better luck next time!</h1>";

        return $htmlGameOver;
    }

    // Create a onscreen keyboard form
    public function displayKeyboard()
    {

        $selectedLetters = $_SESSION['selectedLetters'];

        $keyRow1 = array("q", "w", "e", "r", "t", "y", "u", "i", "o", "p");
        $keyRow2 = array("a", "s", "d", "f", "g", "h", "j", "k", "l");
        $keyRow3 = array("z", "x", "c", "v", "b", "n", "m");

        // keyrow1
        $htmlKeyRow1 = "<div class='keyrow'>";
        foreach($keyRow1 as $letter) {
            if(!in_array($letter, $selectedLetters)) {
                $htmlKeyRow1 .= "<button class='key' type='submit' name='key' value='" . $letter . "'>$letter</button>";
            } else {
                if($this->phrase->checkLetter($letter, $this->phrase->currentPhrase)) {
                    // If $letter is in $selectedLetters and in the currentPhrase
                    $htmlKeyRow1 .= "<button class='key correct' disabled>$letter</button>";
                } else {
                    // If $letter is in $selectedLetters but not in the currentPhrase
                    $htmlKeyRow1 .= "<button class='key incorrect' style='background-color: red' disabled>$letter</button>";
                }
            }
        }
        $htmlKeyRow1 .= "</div>";

        // keyrow2
        $htmlKeyRow2 = "<div class='keyrow'>";
        foreach($keyRow2 as $letter) {
            if(!in_array($letter, $selectedLetters)) {
                $htmlKeyRow2 .= "<button class='key' type='submit' name='key' value='" . $letter . "'>$letter</button>";
            } else {
                if($this->phrase->checkLetter($letter, $this->phrase->currentPhrase)) {
                    $htmlKeyRow2 .= "<button class='key correct' disabled>$letter</button>";
                } else {
                    $htmlKeyRow2 .= "<button class='key incorrect' style='background-color: red' disabled>$letter</button>";
                }
            }
        }
        $htmlKeyRow2 .= "</div>";

        // keyrow3
        $htmlKeyRow3 = "<div class='keyrow'>";
        foreach($keyRow3 as $letter) {
            if(!in_array($letter, $selectedLetters)) {
                $htmlKeyRow3 .= "<button class='key' type='submit' name='key' value='" . $letter . "'>$letter</button>";
            } else {
                if($this->phrase->checkLetter($letter, $this->phrase->currentPhrase)) {
                    $htmlKeyRow3 .= "<button class='key correct' disabled>$letter</button>";
                } else {
                    $htmlKeyRow3 .= "<button class='key incorrect' style='background-color: red' disabled>$letter</button>";
                }
            }
        }
        $htmlKeyRow3 .= "</div>";

        // Build the main keyboard
        $htmlKeyboard = "<form action='play.php' method='post'>";
        $htmlKeyboard .= "<div id='qwerty' class='section'>";
        $htmlKeyboard .= $htmlKeyRow1;
        $htmlKeyboard .= $htmlKeyRow2;
        $htmlKeyboard .= $htmlKeyRow3;
        $htmlKeyboard .= "</div>";
        $htmlKeyboard .= "</form>";

        return $htmlKeyboard;
    }

    // Display the number of guesses available
    public function displayScore()
    {
        $htmlScoreBoard = "<div id='scoreboard' class='section'>";
        $htmlScoreBoard .= "<ol>";
        for($x = 0; $x <= $this->lives; $x++) {
            $htmlScoreBoard .= "<li class='tries'><img src='images/loseHeart.png' height='35px' widght='30px'></li>";
        }
        $htmlScoreBoard .= "</ol>";
        $htmlScoreBoard .= "</div>";

        return $htmlScoreBoard;
    }
}