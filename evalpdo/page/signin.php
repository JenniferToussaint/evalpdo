<?php
include("../header.php");
require '../script-php/connexion.php';
require '../class/class-utilisateur.php';


$userManager = new UserManager($bdd);
?>

<body>
    <h1 class="text-center">Identification</h1>

    <form action="" method="post" class=" text-center ">

        <label for="mail">Mail</label> <br>
        <input type="text" id="mail" name="mail" required> <br><br>

        <label for="password">Mot de Passe</label> <br>
        <input type="password" id="password" name="password" required> <br><br>


        <button type="submit" name='valider'>Connexion</button>

        <button type="submit">Annuler</button>

        </label>

    </form>

    <a href="../index.php">Retour</a>

    <?php

    if (isset($_POST['valider']) && isset($_POST['mail'])) {
        $user = $userManager->login($_POST['mail']);
        if (!$user) {
            echo 'Mauvais identifiant';
        } else {
            if (password_verify($_POST['password'],$user->password_u())){
                $_SESSION['mail_u'] = $user->mail_u();
                $_SESSION['id_user'] = $user->id_user();

                header('Location: ../index.php');
            } else {
                echo ' Mauvais mot de passe';
            }
        }
    }

    ?>
</body>

</html>