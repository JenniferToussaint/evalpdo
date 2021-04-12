<?php
    require_once 'model/model-auteur.php';

    function listAuthors(){
        $authorManager=new AuteurManager();
        $authors = $authorManager->getAuthors();
        require 'view/listAuteurView.php';
    }

    function author(){
        $authorManager=new AuteurManager();
        $author=$authorManager->getAuthor($_GET['id']);
        require 'view/auteurView.php';
    }
?>