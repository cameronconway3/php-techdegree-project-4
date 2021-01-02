<?php 

    ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);
    
    include "./inc/Phrase.php";
    include "./inc/Game.php";
    
    $phrase = new Phrase("Hello guys", array());

    $game = new Game($phrase);
    

    echo $game->displayKeyboard();

	


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
    </div>

    


</div>

</body>
</html>
