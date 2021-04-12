<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/83f4286022.js" crossorigin="anonymous"></script>

    <title>Eval</title>
</head>

<body>
<div class="d-flex justify-content-around">
    <h2><a href="index.php" class="text-dark"> Accueil</a></h2>
    <?php

    if(!isset($_SESSION['id_user'])){
        echo '
        <h2> <a href="./page/signin.php" class="text-dark">S`\'identifier</a></h2> <br>
        <h2> <a href="./page/register.php" class="text-dark">S`\'enregistrer</a></h2> <br>';
    }else{
        echo ' <h2><a href="index.php?action=user" class="text-dark">Afficher utilisateur</a></h2>
        <h2><a href="index.php?action=listAuteur" class="text-dark">Afficher auteur</a></h2>

        <h2><a href="index.php?action=editeur" class="text-dark">Afficher les editeurs</a></h2>
        
        <br>
        <h2> <a href="script-php/deconnexion.php" class="text-dark">Deconnexion</a></h2>';
    }

    ?>
</div>

</body>

</html>