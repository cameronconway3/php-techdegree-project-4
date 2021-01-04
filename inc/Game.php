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
        $htmlKeyboard = "<form action='play.php' method='post' class='keyboard-display'>";
        $htmlKeyboard .= "<div id='qwerty' class='section'>";
        $htmlKeyboard .= $htmlKeyRow1;
        $htmlKeyboard .= $htmlKeyRow2;
        $htmlKeyboard .= $htmlKeyRow3;
        $htmlKeyboard .= "</div>";
        $htmlKeyboard .= "</form>";

        return $htmlKeyboard;
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

    // Display score (number of lives)
    public function displayScore()
    {
        // Lives left
        $livesLeft = $this->lives - $this->phraseObj->numberLost();
        // Lives lost
        $livesLost = $this->lives - $livesLeft;
        
        $htmlScoreBoard = "<div id='scoreboard' class='section'>";
        $htmlScoreBoard .= "<ol>";
        // While livesLeft is more than 0 display hearts.
        if($livesLeft > 0) {
            // Loop through lives left and display liveHeart.png
            for($x = 1; $x <= $livesLeft; $x++) {
                $htmlScoreBoard .= "<li class='tries'><img src='images/liveHeart.png' height='35px' widght='30px'></li>";
            }
            // Loop through lives lost and display lostHeart.png
            for($x = 1; $x <= $livesLost; $x++) {
                $htmlScoreBoard .= "<li class='tries'><img src='images/lostHeart.png' height='35px' widght='30px'></li>";
            }
        }
        $htmlScoreBoard .= "</ol>";
        $htmlScoreBoard .= "</div>";

        return $htmlScoreBoard;
    }
    
    // Checks to see if the player has guessed too many wrong letters
    public function checkForLose()
    {
        if($this->phraseObj->numberLost() == $this->lives) {
            return true;
        }
        return false;
    }

    // Displays one message if the player wins and another message if they lose. It returns false if the game has not been won or lost
    public function gameOver()
    {
        if($this->checkForLose()) {
            $htmlLose = "<h1 id='game-over-message' style='color:white'>The phrase was: '" . $this->phraseObj->currentPhrase . "'. Better luck next time!</h1>";
            $htmlLose .= "<script>document.getElementsByTagName('h2')[0].style.color='white'; </script>";
            $htmlLose .= "<script>document.getElementsByTagName('body')[0].style.background='red'; </script>";
            $htmlLose .= "<form action='play.php' method='post'>";
            $htmlLose .= "<input id='btn__reset' type='submit' name='start' value='Restart Game' />";
            $htmlLose .= "</form>";

            return $htmlLose;
        }
        if($this->checkForWin()) {
            $htmlWin = "<h1 id='game-over-message' style='color:white'>Congratulations on guessing: '" . $this->phraseObj->currentPhrase . "'</h1>";
            $htmlWin .= "<script>document.getElementsByTagName('h2')[0].style.color='white'; </script>";
            $htmlWin .= "<script>document.getElementsByTagName('body')[0].style.background='green';</script>";
            $htmlWin .= "<form action='play.php' method='post'>";
            $htmlWin .= "<input id='btn__reset' type='submit' name='start' value='Restart Game' />";
            $htmlWin .= "</form>";

            return $htmlWin;
        }
        return false;
    }
    
    // Checks to see if the player has selected all of the letters
    public function checkForWin()
    {
        // Letters in both selected letters array and the currentPhrase array
        $presentInBoth = array_intersect($this->phraseObj->selected, $this->phraseObj->getLetterArray());

        // If selected letters and those returned from 'getLettersArray()' have same amount return true
        if(count($presentInBoth) == count($this->phraseObj->getLetterArray())) {
            return true;
        }
        return false;
    }


    

}