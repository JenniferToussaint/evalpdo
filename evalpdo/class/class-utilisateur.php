<?php

class User
{

    //Atributs de réalisation
    private $id_user;
    private $nom_u;
    private $prenom_u;
    private $mail_u;
    private $avatar;
    private $date_naissance_u;
    private $password_u;

    //Getter

    public function id_user()
    {
        return $this->id_user;
    }
    public function nom_u()
    {
        return $this->nom_u;
    }
    public function prenom_u()
    {
        return $this->prenom_u;
    }
    public function mail_u()
    {
        return $this->mail_u;
    }
    public function avatar()
    {
        return $this->avatar;
    }
    public function date_naissance_u()
    {
        return $this->date_naissance_u;
    }

    public function password_u()
    {
        return $this->password_u;
    }


    //Setter


    public function setId_user($id)
    {
        $this->id_user = (int) $id;
    }

    public function setNom_u($nom)
    {
        $this->nom_u= $nom;
    }
    public function setPrenom_u($prenom)
    {
        $this->prenom_u= $prenom;
    }

    public function setMail_u($mail)
    {
        $this->mail_u= $mail;
    }
    
    public function setAvatar($avatar)
    {
        $this->avatar= $avatar;
    }
    public function setDate_naissance_u($date)
    {
        $this->date_naissance_u= $date;
    }

    public function setPassword_u($password)
    {
        $this->password_u = $password;
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


class UserManager {
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

    public function add(User $user) {
        $requete=$this->bdd->prepare('INSERT INTO utilisateurs (nom_u, prenom_u, mail_u, date_naissance_u, password_u) VALUES(:nom_u, :prenom_u, :mail_u, :date_naissance_u, :password_u)');

        $requete->bindValue(':nom_u', $user->nom_u(),PDO::PARAM_STR);
        $requete->bindValue(':prenom_u', $user->prenom_u(),PDO::PARAM_STR);
        $requete->bindValue(':mail_u',$user->mail_u());
        $requete->bindValue(':date_naissance_u',$user->date_naissance_u(),PDO::PARAM_STR);
        $requete->bindValue(':password_u',$user->password_u(),PDO::PARAM_STR);

        $requete->execute();
    }

    //SUPPRIME & GET ID

    public function delete(User $user) {

        $this->bdd->exec('DELETE FROM utilisateurs WHERE id_user = '.$user->id_user());
    }

    public function get($id) {
        // Je m'assure que l'Id est bien un entier
        $id = (int) $id;

        $requete = $this->bdd->prepare('SELECT * FROM utilisateurs WHERE id_user = ?');
        $requete->execute(array($id));
        //PDO::FETCH_ASSOC retourne un tableau associtatif indexé par le nom des champs

        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        // Je créé un nouvel objet user

        $user = new User();
        // Je l'hydrate et je retourne le résulatat de ma méthode
        $user->hydrate($donnees);
        return $user;
    }

    // MODIF & GET ID

    public function getAll(){
        //J'initialise un tableau vide qui contiendra l'ensemble de mes users
        $users = [];

        $requete = $this->bdd->query('SELECT * FROM utilisateurs');

        while($donnees = $requete->fetch(PDO::FETCH_ASSOC)){
            $user = new User();
            $user->hydrate($donnees);
            $users[] = $user;
        }

        return $users;

    }

    public function update(User $user) {
            $requete = $this->bdd->prepare('UPDATE utilisateurs SET nom_u = :nom_u, prenom_u = :prenom_u, mail_u = :mail_u, avatar = :avatar, date_naissance_u = :date_naissance_u, password_u = :password_u WHERE id_user = :id_user');

            $requete->bindValue(':id_user', $user->id_user(),PDO::PARAM_INT);
            $requete->bindValue(':nom_u', $user->nom_u(),PDO::PARAM_STR);
            $requete->bindValue(':prenom_u', $user->prenom_u(),PDO::PARAM_STR);
            $requete->bindValue(':mail_u',$user->mail_u());
            $requete->bindValue(':avatar',$user->avatar());
            $requete->bindValue(':date_naissance_u', $user->date_naissance_u());
            $requete->bindValue(':password_u',$user->password_u(),PDO::PARAM_STR);

            $requete->execute();

        }

        public function login($email){
            $req = $this->bdd->prepare('SELECT * FROM utilisateurs WHERE mail_u =?');
            $req->execute(array($email));
            if($donnees = $req->fetch(PDO::FETCH_ASSOC)){
                $user = new USER();
                $user->hydrate($donnees);
                return $user;
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