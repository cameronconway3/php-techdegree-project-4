<?php 
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    session_start();

    include "./inc/Phrase.php";
    include "./inc/Game.php";

    // When start is submitted reset the $_SESSION variables
    if (isset($_POST['start'])) {
        unset($_SESSION['selected']);
        unset($_SESSION['phrase']);
    }

    if (!isset($_SESSION["selected"])) {
        $_SESSION["selected"] = array(); 
    }

    if(isset($_POST['key'])) {

        // Store the chosen letter in a session called 'selected'
        array_push($_SESSION['selected'], $_POST['key']);

        $phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
    } 

    // var_dump($_SESSION['phrase']);
    // var_dump($_SESSION['selected']);
    

    if(!isset($_SESSION['phrase'])){
        $phrase = new Phrase();
    }
    
    $game = new Game($phrase);

    $_SESSION['phrase'] = $phrase->currentPhrase;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
    <div class="main-container">
        <div id="banner" class="section">
            <h2 class="header">Phrase Hunter</h2>

            <?php 
                if(!$game->gameOver()) {
                    echo $phrase->addPhraseToDisplay();
                    echo $game->displayKeyboard();
                    echo $game->displayScore();
                } else {
                    echo $game->gameOver();
                }
            ?>

        </div>
    </div>
    <script src="./js/index.js"></script>

</body>
</html>