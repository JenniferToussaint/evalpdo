<?php

class Edition
{
    //Atributs de réalisation
    private $id_ed;
    private $nom_ed;
  
    //Getter

    public function id_ed()
    {
        return $this->id_ed;
    }
    public function nom_ed()
    {
        return $this->nom_ed;
    }

    //Setter

    public function setId_ed($id)
    {
        $this->id_ed = (int) $id;
    }

    public function setNom_ed($nom)
    {
        $this->nom_ed= $nom;
    }

    public function hydrate(array $donnee)
    {
        //On fait une boucle chacune des propriétés du tableau associatif
        foreach ($donnee as $key => $value) {
            $method = 'set' . ucfirst($key);
            //Pour mettre la première lettre en majuscule
            if (method_exists($this, $method)) {
                $this->$method($value);
                //Si la methode $methode existe dans cette classe this alors afficher
            }
        }
    }


}

// CLASS MANAGER

class EditionManager {
    private $bdd;

    public function setDb(PDO $bdd) {
        $this->bdd = $bdd;
    }

    //A l'initialisation de mon manager je lui donne la connexion à la Bdd

    public function __construct($bdd)
    {
        $this->setDb($bdd);
    }


    //AJOUT

    public function add(Edition $edite) {
        $requete=$this->bdd->prepare('INSERT INTO edition (nom_ed) VALUES(:nom_ed)');
        $requete->bindValue(':nom_ed', $edite->nom_ed(),PDO::PARAM_STR);
        $requete->execute();
    }

    //SUPPRIME & GET ID

    public function delete(Edition $edite) {

        $this->bdd->exec('DELETE FROM edition WHERE id_ed = '.$edite->id_ed());
    }

    public function get($id) {
        // Je m'assure que l'Id est bien un entier
        $id = (int) $id;

        $requete = $this->bdd->prepare('SELECT * FROM edition WHERE id_ed = ?');
        $requete->execute(array($id));
        //PDO::FETCH_ASSOC retourne un tableau associtatif indexé par le nom des champs

        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        // Je créé un nouvel objet user

        $editeur = new Edition();
        // Je l'hydrate et je retourne le résulatat de ma méthode
        $editeur->hydrate($donnees);
        return $editeur;
    }

    // MODIF & GET ID

    public function getAll(){
        //J'initialise un tableau vide qui contiendra l'ensemble de mes users
        $editeurs = [];

        $requete = $this->bdd->query('SELECT * FROM edition');

        while($donnees = $requete->fetch(PDO::FETCH_ASSOC)){
            $editeur = new Edition();
            $editeur->hydrate($donnees);
            $editeurs[] = $editeur;
        }

        return $editeurs;
    }

    public function update(Edition $edite) {
            $requete = $this->bdd->prepare('UPDATE edition SET nom_ed = :nom_ed WHERE id_ed = :id_ed');
            $requete->bindValue(':id_ed', $edite->id_ed(),PDO::PARAM_INT);
            $requete->bindValue(':nom_ed', $edite->nom_ed(),PDO::PARAM_STR);
            $requete->execute();

        }

        public function edition($edite){
            $req = $this->bdd->prepare('SELECT * FROM edite WHERE id_ed =?');
            $req->execute(array($edite));
            if($donnees = $req->fetch(PDO::FETCH_ASSOC)){
                $editeur = new USER();
                $editeur->hydrate($donnees);
                return $editeur;
            }else{
                return false;
            }
        }
    }


function affichTab($tab) {
    echo '<pre>';
    print_r($tab);
    echo '</pre>';
}