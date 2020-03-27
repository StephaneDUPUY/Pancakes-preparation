<?php

    $ingredients = [
        "Farine" => 250,
        "Oeufs"=> 4,
        "Lait"=> 50,
        "Sel"=> 1,
        "Beurre"=> 50,
        "Sucre vanillé"=> 1,
        "Cuillère à soupe de Fleur d'Oranger"=>1,
    ];

    $numberGuests = 8;

    // check nuùber of guests
    if(isset($_GET['number'])) {
        $numberGuests = intval($_GET["number"]);
    }

    if($numberGuests < 8){
        $message = " Il n'y a pas assez d'invités ...";
    }
    else if ($numberGuests > 20){
        $message = "Il y a trop d'invités !";
    }
    else{
        $message = ""; 
        $ingredients = recipe($numberGuests,$ingredients);
    }


    // return a message aleatory from a list
    function aleatoryMessage() {
        $messagesList = [
            "J'ai trop mangé, je vais bien dormir ce soir!",
            "Délicieux",
            "Il n'y en a pas assez pour moi !",
            "C'est une recette bretonne !",
            "Tu es sûr que ce sont des crêpes ?",
        ];


        $randomKey = mt_rand(0,4);

        return $messagesList[$randomKey];
    }

    // return quantity ingredinets based number of guests (and its coef)
    function recipe($guests, $ingredients){
        if($guests > 8 && $guests < 11){
            $coef = 1.5;
        }
        else if($guests >= 11 && $guests < 14){
            $coef = 1.8;
        }
        else if($guests >= 14 && $guests < 16){
            $coef = 2;
        }
        else if($guests >= 16 && $guests <= 20){
            $coef = 4;
        }
        else {
            $coef = 1;
        }

        foreach($ingredients as $label => $quantity ) {
        $ingredients[$label] =  $quantity * $coef;
        }

        return $ingredients;
    }

    // convert gram in oz
    function gramOz($quantity) {
        // 1 oz = 28 g

        $quantityOz = round($quantity / 28);

        return $quantityOz . ' oz';
    }

    // convert gram in livre
    function gramLivre($quantity) {

        $quantityLb = round($quantity / 453, 2);

        return $quantityLb . ' lb';
    }

    function nbCalories ($nbGuests) {
        return $nbGuests * 2 * 60;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Recette de crêpes</title>
    </head>
    <body>
            <div><?= $message ?> </div>
            <form action="">
                <div>
                    <label for="guests">Nombre d'invités</label>
                    <input type="number" id="guests" name="number" >
                    <button>Envoyer</button>
                </div>

            </form>

            <div>
                <h1>Ingredients</h1>
                <ul>
                    <?php
                    foreach($ingredients as $label => $quantity) {

                        echo '<li>'.$label.' : '.$quantity.'</li>';

                    }

                    ?>
                </ul>
            </div>

            <div>
                <h2>Poids en Oz</h2>
                <ul>
                    <li>Farine : <?= gramOz($ingredients['Farine'])?></li>
                    <li>Beurre : <?= gramOz($ingredients['Beurre'])?></li>

                </ul>
            </div>
            <div>
                <h2>Poids en Livre</h2>
                <ul>
                    <li>Farine : <?= gramLivre($ingredients['Farine'])?></li>
                    <li>Beurre : <?= gramLivre($ingredients['Beurre'])?></li>

                </ul>
            </div>
            <div>
                <h2>Calories pour l'ensemble des invités</h2>
                Calories pour l'ensemble des invités : <?= nbCalories($numberGuests) ?>
            </div>
            <div>
                <h2>Niveau de discussion invités</h2>
                Conversations : <?= aleatoryMessage() ?>
            </div>
    </body>
</html>