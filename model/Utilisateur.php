<?php
    require_once("conf/Connexion.php");
    Connexion::connect();
class Utilisateur
{
    private $pkNumUtilisateur;
    private $nomUtilisateur;
    private $prenomUtilisateur;
    private $pseudoUtilisateur;     // Le pseudo doit être unique
    private $mdpUtilisateur;
    private $banUtilisateur;

    public function getpkNumUtilisateur(){return $this->pkNumUtilisateur;}
    public function getnomUtilisateur(){return $this->nomUtilisateur;}
    public function getprenomUtilisateur(){return $this->prenomUtilisateur;}
    public function getpseudoUtilisateur(){return $this->pseudoUtilisateur;}
    //private function getmdpUtilisateur(){return $this->mdpUtilisateur;}
    public function getbanUtilisateur(){return $this->banUtilisateur;}

    public function __construct($numU=NULL,$nomU=NULL,$prenomU=NULL,$pseudoU=NULL, $mdpU=NULL,$banU=NULL){
        if(!is_null($numU)){
            $this->pkNumUtilisateur = $numU;
            $this->nomUtilisateur= $nomU;
            $this->prenomUtilisateur=$prenomU;
            $this->pseudoUtilisateur = $pseudoU;
            $this->mdpUtilisateur = $mdpU;
            $this->banUtilisateur = $banU;
        }
    }

    public static function getAllUtilisateur() {
        $requete = "SELECT * FROM Utilisateur ORDER BY nomUtilisateur;";
        $reponse = Connexion::pdo()->query($requete);
        $reponse->setFetchMode(PDO::FETCH_CLASS,'Utilisateur');
        $tab = $reponse->fetchAll();
        return $tab;
    }

    public static function getAllUtilisateurbyPseudo($Pseudo) {
        $requetePreparee = "SELECT * from Utilisateur where PseudoUtilisateur = :tag_Pseudo;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_Pseudo" => $Pseudo);
        $req_prep->execute($valeurs);
        return $req_prep;
    }

    public static function getUtilisateurByNumCommentaire($numCommentaire){
        $requetePreparee =
            "SELECT DISTINCT Utilisateur.nomUtilisateur, Utilisateur.prenomUtilisateur, Utilisateur.pseudoUtilisateur
            FROM Utilisateur 
            JOIN Commentaire ON(Utilisateur.numUtilisateur=Commentaire.numUtilisateur)
            JOIN Recette ON(Commentaire.numRecette=Recette.numRecette)
            Where Commentaire.numCommentaire = :tag_numCommentaire";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numCommentaire" => $numCommentaire);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Commentaire');
            $tab = $req_prep->fetchall();
            if (!$tab)
                return false;
            return $tab;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }

    public static function getUtilisateurByNumRecette($numRecette){
        $requetePreparee =
            "SELECT DISTINCT Utilisateur.nomUtilisateur, Utilisateur.prenomUtilisateur, Utilisateur.pseudoUtilisateur
            FROM Utilisateur 
            JOIN Recette ON(Utilisateur.numUtilisateur=Recette.numUtilisateur)
            Where Recette.numRecette = :tag_numRecette";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Commentaire');
            $tab = $req_prep->fetch();
            if (!$tab)
                return false;
            return $tab;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }

    public static function getNumUtilisateurbyPseudoUtilisateur($pseudoUtilisateur)
    {
        $requetePreparee = "SELECT numUtilisateur FROM Utilisateur where pseudoUtilisateur = :tag_PseudoUtilisateur;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_PseudoUtilisateur" => $pseudoUtilisateur);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Recette');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }


    public static function addUtilisateur($nomUtilisateur,$prenomUtilisateur,$pseudoUtilisateur,$mdpUtilisateur) {
        $requetePreparee = "INSERT INTO Utilisateur (nomUtilisateur,prenomUtilisateur,pseudoUtilisateur,mdpUtilisateur) VALUES(:tag_nomUtilisateur,:tag_prenomUtilisateur,:tag_pseudoUtilisateur,:tag_mdpUtilisateur);";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array(
            "tag_nomUtilisateur" => $nomUtilisateur,
            "tag_prenomUtilisateur" => $prenomUtilisateur,
            "tag_pseudoUtilisateur" => $pseudoUtilisateur,
            "tag_mdpUtilisateur" => $mdpUtilisateur
        );
        try {
            $req_prep->execute($valeurs);
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
    }

    public static function deleteUtilisateur($numUtilisateur) {
        $requetePreparee = "DELETE FROM Utilisateur WHERE numUtilisateur = :tag_numUtilisateur;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numUtilisateur" => $numUtilisateur);
        try {
            $req_prep->execute($valeurs);
            return true;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }

    /*
     * méthode qui permet de rechercher une recette existante
     */
    public static function rechercherUtilisateur($pseudoUtilisateur){
        $requetePreparee = "SELECT nomUtilisateur,prenomUtiisateur,pseudoUtilisateur FROM Utilisateur where pseudoUtilisateur = :tag_pseudoUtilisateur;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_pseudoUtilisateur" => $pseudoUtilisateur);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Utilisateur');
            $tab = $req_prep->fetchAll();
            if (!$tab)
                return false;
            return $tab;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }
}