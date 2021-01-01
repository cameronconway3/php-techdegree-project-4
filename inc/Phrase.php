<?php
// session_start();

class Phrase
{
    private $currentPhrase;
    private $selected = array();

    public function __construct($phrase = null, $selected)
    {
        $this->setPhrase($phrase);

        // $selected - an array of selected letters
        $_SESSION['selectedLetters'] = $selected;
        $this->selected = $selected;
    }

    // $phrase - a string, or if empty, get a random phrase
    public function setPhrase($phrase)
    {
        if(empty($phrase)) {
            $this->currentPhrase = randomPhrase();
            $_SESSION['currentPhrase'] = randomPhrase();
        } else {
            $this->currentPhrase = $phrase;
            $_SESSION['currentPhrase'] = $phrase;
        }
    }

    // Builds the HTML for the letters of the phrase. Each letter is presented by an empty box, one list item for each letter.
    public function addPhraseToDisplay($currentPhrase)
    {
        // Convert all letters into lowercase
        $currentPhrase = strtolower($currentPhrase);

        $listElementsArr = array();

        $strArr = str_split($currentPhrase);
        foreach($strArr as $char) {
            // If value of $char is a space
            if($char == " ") {
                $listElement = "<li class='hide space'></li>";
            } else {
                $listElement = "<li class='hide letter $char'>$char</li>";
            }
            array_push($listElementsArr, $listElement);
        }

        $phraseToDisplay = "<div id='phrase' class='section'>";
        $phraseToDisplay .= "<ul>";
        foreach($listElementsArr as $element) {
            $phraseToDisplay .= $element;
        }
        $phraseToDisplay .= "</ul>";
        $phraseToDisplay .= "</div>";

        return $phraseToDisplay;
    }

    // Checks to see if a letter matches a letter in the phrase. Accepts a single letter to check against the phrase. Returns true or false.
    public function checkLetter($letter, $currentPhrase)
    {
        // Remove whitespace from $currentPhrase
        $strippedPhrase = str_replace(' ', '', $currentPhrase);
        
        // Turn $strippedPhrase into array
        $strArr = str_split($strippedPhrase);

        // If letter is in $strArr 
        if(in_array($letter, $strArr)) {
            return true;
        } else {
            return false;
        }
    }

}