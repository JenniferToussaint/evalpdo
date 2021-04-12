<?php

require 'script-php/connexion.php';
require 'class/class-edition.php';

$editeurManager = new EditionManager($bdd);

?>

<body>
    <h1 class="p-5 text-center">Liste des Edition des livres</h1>


    <?php

    $editeurs = $editeurManager->getAll();

    ?>

    <table class="table">
        <thead>
            <th>Identifiant</th>
            <th>Editeur</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </thead>
        <tbody>
        <?php

        foreach ($editeurs as $value) {
            
            echo '
            <tr>
            <td>'.$value->id_ed().'</td>
            <td>'.$value->nom_ed().'</td>

            <td>
                <a href="modif_edition.php?id='.$value->id_ed().'" class="btn btn-outline-success"> Modifier</a>
                </td>
                <td>
                    <a href="supprim_editeur.php?id='.$value->id_ed().'" class="btn btn-outline-danger"> Supprimer</a>
                </td>
                </tr>
                ';

        }


        ?>
        </tbody>
    </table>



</body>
</html>