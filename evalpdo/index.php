<?php
include("header.php");
?>


<h1 class="text-center m-5">BIENVENUE</h1>

<?php
require 'controller/control-auteur.php';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'listAuteur':
            listAuthors();
            break;


            case 'user':
                include('page/user.php');
                break;

                case 'listAuteur':
                    listAuthors();
                    break;

                    case 'editeur':
                        include('page/edition.php');
                        break;


      

            case 'auteur'; {
                if(isset($_GET['id'])) {
                    author($_GET['id']);
                }else {
                    echo 'pas d\'identifiant selectionné';
                }
                break;
            }
            default;
            echo 'Erreur';
            break;

      
    }
}



?>