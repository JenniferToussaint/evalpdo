<?php


require 'script-php/connexion.php';
require 'class/class-utilisateur.php';

$userManager = new UserManager($bdd);

?>

<body>
    <h1 class="p-5 text-center">Utilisateur</h1>

    <?php

    $users = $userManager->getAll();

    ?>

    <table class="table">
        <thead>
            <th>Identifiant</th>
            <th>Avatar</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </thead>
        <tbody>
        <?php

        foreach ($users as $value) {
            
            echo '
            <tr>
            <td>'.$value->id_user().'</td>
            <td>'.$value->avatar().'</td>
            <td>'.$value->nom_u().'</td>
            <td>'.$value->prenom_u().'</td>
            <td>'.$value->mail_u().'</td>
            <td>
                <a href="page/modif.php?id='.$value->id_user().'" class="btn btn-outline-success"> Modifier</a>
                </td>
                <td>
                    <a href="page/supprim.php?id='.$value->id_user().'" class="btn btn-outline-danger"> Supprimer</a>
                </td>
                </tr>
                ';

        }


        ?>
        </tbody>
    </table>

    <a href="../index.php">Retour</a>

</body>
</html>