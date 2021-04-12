<?php

require '../script-php/connexion.php';
require '../class/class-edition.php';
session_start();
$id =$_GET['id'];
$editeurManager = new EditionManager($bdd);
 $unediteur = $editeurManager->get($id);

 $editeurManager->delete($unediteur);
 header('Location: edition.php');

?>