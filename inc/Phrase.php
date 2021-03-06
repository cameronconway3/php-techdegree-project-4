<?php

class Phrase
{
    public $currentPhrase;
    public $selected = array();
    public $randomPhrases = array(
        "Life is like a box of chocolates", 
        "There is not trying", 
        "May the force be with you", 
        "You have to see the matrix for yourself", 
        "You talking to me"
    );

    public function __construct(String $currentPhrase = null, Array $selected = array())
    {
        // If $currentPhrase is not empty, assign it to the $currentPhrase class property value. 
        // Else assign $currentPhrase class property to random phrase from the $randomPhrases class property array.
        if(!empty($currentPhrase)) {
            $this->currentPhrase = $currentPhrase;
        } else {
            $randomIndex = array_rand($this->randomPhrases);
            $this->currentPhrase = $this->randomPhrases[$randomIndex];

            // $this->currentPhrase = "dream big";
        }

        // If $selected is not empty, assign it to the $selected class property value.
        if(!empty($selected)) {
            $this->selected = $selected;
        }
    }
    
    // Builds the HTML for the letters of the phrase. Each letter is presented by an empty box, one list item for each letter.
    public function addPhraseToDisplay()
    {
        // Array to hold the elements
        $listElementsArr = array();

        // Convert all letters into lowercase and turn into array
        $charactersArr = str_split(strtolower($this->currentPhrase));

        foreach($charactersArr as $char) {
            // If value of $char is a space
            if($char == " ") {
                $listElement = "<li class='hide space'></li>";
            } else {
                if(in_array($char, $this->selected)) {
                    $listElement = "<li class='show letter $char'>$char</li>";
                } else {
                    $listElement = "<li class='hide letter $char'>$char</li>";
                }
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
    public function checkLetter($letter)
    {
        // If letter is in $uniqueLettersArr 
        if(in_array($letter, $this->getLetterArray())) {
            return true;
        } else {
            return false;
        }
    }

    // Get an array of unique lowercase characters excluding empty space
    public function getLetterArray()
    {
        // Array of unique lowercase letters only in the currentPhrase
        return array_unique(str_split(str_replace(' ', '', strtolower($this->currentPhrase))));
    }

    // Return the number of incorrect guesses
    public function numberLost()
    {
        // Returns selected letters that aren't in $currentPhrase
        $incorrectLetters = array_diff($this->selected, $this->getLetterArray());

        // Return the amount of $incorrectLetters using the 'count' function.
        return count($incorrectLetters);
    }

}