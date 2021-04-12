<?php

require '../script-php/connexion.php';
require '../class/class-utilisateur.php';
session_start();
$id =$_GET['id'];
$utilisateurManager = new UserManager($bdd);
 $myUser = $utilisateurManager->get($id);

 $utilisateurManager->delete($myUser);
 header('Location: user.php');

?>