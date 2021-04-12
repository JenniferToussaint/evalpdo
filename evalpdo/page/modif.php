<?php
include("../header.php");
require '../script-php/connexion.php';
require '../class/class-utilisateur.php';

$id = $_GET['id'];
$userManager = new UserManager($bdd);
$myUser = $userManager->get($id);
?>


<body>

    <h2>Modifications</h2>

    <form action=" " method="post" enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $myUser->id_user(); ?>">

        <label for="nom">Nom</label><br>
        <input type="text" name="nom" value="<?php echo $myUser->nom_u() ?>"><br>

        <label for="prenom">Prénom</label><br>
        <input type="text" name="prenom" value="<?php echo $myUser->prenom_u() ?>"><br>

        <label for="avatar">Avatar</label><br>
        <input type="file" name="avatar" value="<?php echo $myUser->avatar() ?>"><br>

        <label for="mail">Mail</label> <br>
        <input type="text" id="mail" name="mail" value="<?php echo $myUser->mail_u() ?>"> <br><br>

        <label for="date">Date de naissance</label> <br>
        <input type="text" id="date" name="date" value="<?php echo $myUser->date_naissance_u() ?>"> <br><br>

        <label for="pw">Mot de Passe</label> <br>
        <input type="password" id="pw" name="password" required> <br><br>

        <label for="verifPassword">Re-saisissez le mot de Passe</label> <br>
        <input type="password" id="verifPassword" name="verifPassword" required> <br><br>

        <button type="submit" name='valider'>Modifer</button>

        <button type="submit">Annuler</button>

        </label>

    </form>

    <?php

    if (isset($_POST['valider'])) {
        if (empty($_POST['password']) || ($_POST['password'] == $_POST['verifPassword'])) {

            $myUser->setPassword_u(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]));
            $myUser->setNom_u($_POST['nom']);
            $myUser->setPrenom_u($_POST['prenom']);
            $myUser->setAvatar($_POST['avatar']);
            $myUser->setMail_u($_POST['mail']);
            $myUser->setDate_naissance_u($_POST['date']);


            $userManager->update($myUser);
            header('Location: user.php');
        } else {
            echo 'Les mots de passent ne corespondent pas';
        }
    }


    ?>


</body>

</html>