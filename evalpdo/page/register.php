<?php
include("../header.php");
require '../script-php/connexion.php';
require '../class/class-utilisateur.php';


$userManager = new UserManager($bdd);
?>



<body>

    <h1>Enregistrement</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <label for="nom">Nom</label> <br>
        <input type="text" id="nom" name="nom" required> <br><br>

        <label for="prenom">Prénom</label> <br>
        <input type="text" id="prenom" name="prenom" required> <br><br>

        <label for="mail">Mail</label> <br>
        <input type="text" id="mail" name="mail" required> <br><br>

        <label for="avatar">Avatar </label><br>
        <input type="file" name="avatar" id="avatar"><br><br>

        <label for="date">Date de naissance</label> <br>
        <input type="date" id="date" name="date"> </input> <br><br>

        <label for="password">Mot de Passe</label> <br>
        <input type="password" id="password" name="password" required> <br><br>

        <label for="verifPassword">Re-saisissez le mot de Passe</label> <br>
        <input type="password" id="verifPassword" name="verifPassword" required> <br><br>

        <button type="submit" name='valider'>Inscription</button>

        <button type="submit">Annuler</button>

        </label>

    </form>

    <?php

    if (isset($_POST['valider'])) {

        if ($_POST['password'] == $_POST["verifPassword"]) {

            $post =  [
                'nom_u' => $_POST['nom'],
                'prenom_u' => $_POST['prenom'],
                'mail_u' => $_POST['mail'],
                'avatar_u' => $_POST['avatar'],
                'date_naissance_u' => $_POST['date'],
                'password_u' => password_hash($_POST['password'], PASSWORD_BCRYPT)
            ]; 

            $user = new User();
            $user->hydrate($post);
        
         
            $userManager->add($user);
            $_SESSION['mail_u']=$user->mail_u();
            $_SESSION['id_user']=$user->id_user();

             header("Location:../index.php");

        } else {
            echo " Les MDP ne correspondent pas";
        }
    }

    ?>

<a href="../index.php">Retour</a>

</body>

</html>