<?php

    class Auteur{
        private $id_a;
        private $nom_a;
        private $prenom_a;
        private $date_naissance_a;
        private $id_p;

        public function id_a(){
            return $this->id_a;
        }

        public function nom_a(){
            return $this->nom_a;
        }

        public function prenom_a(){
            return $this->prenom_a;
        }

        public function date_naissance_a(){
            return $this->date_naissance_a;
        }

        public function id_p(){
            return $this->id_p;
        }

        public function setId_a($id){
            $this->id_a = $id;
        }

        public function setNom_a($nom){
            $this->nom_a = $nom;
        }

        public function setPrenom_a($prenom){
            $this->prenom_a = $prenom;
        }

        public function setDate_naissance_a($date_naissance){
            $this->date_naissance_a = $date_naissance;
        }

        public function setId_p($id){
            $this->id_p = $id;
        }

        public function hydrate(array $donnees){
            foreach($donnees as $key => $value){
                $method='set'.ucfirst($key);
                if(method_exists($this, $method)){
                    $this->$method($value);
                }
            }
        }

    }

    class AuteurManager{
       

        public function getAuthors(){
            $authors=[];
            $db=$this->dbConnect();
            $req=$db->query('SELECT * FROM auteur');
            while($data = $req->fetch(PDO::FETCH_ASSOC)){
                $aut = new Auteur;
                $aut->hydrate($data);
                $authors[]=$aut;
            }
            return $authors;
        }

        public function getAuthor($id){
            
            $bdd=$this->dbConnect();
            $req=$bdd->prepare('SELECT * FROM auteur WHERE id_a=?');
            $req->execute(array($id));
            $donnees= $req->fetch(PDO::FETCH_ASSOC);
            $aut= new Auteur();
            $aut->hydrate($donnees);
            return $aut;
        }

        private function dbConnect(){
            $bdd= new PDO('mysql:host=localhost;dbname=livre;charset=utf8','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
           
            return $bdd;
        }
    }
?>