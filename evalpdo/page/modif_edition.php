<?php
include("../header.php");
require '../script-php/connexion.php';
require '../class/class-edition.php';

$id = $_GET['id'];
$editeurManager = new EditionManager($bdd);
$unEditeur = $editeurManager->get($id);
?>


<body>

    <h2>Modifications</h2>

    <form action="" method="post">

    <input type="hidden" value="<?php echo $unEditeur->id_ed(); ?>">

        <label for="nom">Editeur</label>
        <input type="text" name="nom_editeur" value="<?php echo $unEditeur->nom_ed(); ?>">


        <button type="submit" name='valider'>Modifier</button>
        <button type="submit">Annuler</button>

    </form>
<?php
    if (isset($_POST['valider'])) {

        $unEditeur->setNom_ed($_POST['nom_editeur']);

        $editeurManager->update($unEditeur);

        header('Location: edition.php');

    }

    ?>