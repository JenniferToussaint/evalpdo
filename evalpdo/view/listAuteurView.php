<table class="table">
    <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Identifiant pays</th>
            <th>En savoir plus</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($authors as $value){
        echo '
        <tr>
            <td>'.$value->id_a().'</td>
            <td>'.$value->nom_a().'</td>
            <td>'.$value->prenom_a().'</td>
            <td>'.$value->date_naissance_a().'</td>
            <td>'.$value->id_p().'</td>
            <td><a href="index.php?action=auteur&id='.$value->id_a().'">En savoir plus</a></td>
        </tr>
        ';
    }  
?>
    </tbody>
</table>