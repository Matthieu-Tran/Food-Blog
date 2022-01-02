<?php
    require_once("conf/Connexion.php");
    Connexion::connect();
class Commentaire
{
    private $pkNumCommentaire;
    private $descriptionCommentaire;
    private $noteCommentaire;
    private $alerteCommentaire;
    private $fkNumRecette;
    private $fkNumUtilsateur;

    public function getpkNumCommentaire() {return $this->pkNumCommentaire;}
    public function getNoteCommentaire() {return $this->noteCommentaire;}
    public function getAlerteCommentaire() {return $this->alerteCommentaire;}
    public function getfkNumRecette() {return $this->fkNumRecette;}
    public function getfkNumUtilisateur() {return $this->fkNumUtilsateur;}

    public function __construct($numCom = NULL,$noteCom = NULL,$alertCom = NULL,$numRec = NULL,$numUtil = NULL)  {
        if (!is_null($numCom)) {
            $this->pkNumCommentaire = $numCom;
            $this->noteCommentaire = $noteCom;
            $this->alerteCommentaire = $alertCom;
            $this->fkNumRecette = $numRec;
            $this->fkNumUtilsateur = $numUtil;
        }
    }
    public static function getAllCommentaires() {
        $requete = "SELECT * FROM Commentaire ORDER BY NumCommentaire;";
        $reponse = Connexion::pdo()->query($requete);
        $reponse->setFetchMode(PDO::FETCH_CLASS,'Commentaire');
        $tab = $reponse->fetchAll();
        return $tab;
    }


    public static function getCommentaireByNomRecette($nomRecette) {
        $requetePreparee =
        "SELECT DISTINCT Utilisateur.nomUtilisateur, descriptionCommentaire, noteCommentaire
        FROM Commentaire 
        JOIN Recette ON(Commentaire.numRecette=Recette.numRecette)
        JOIN Utilisateur  ON(Utilisateur.numUtillisateur=Commentaire.numUtillisateur)
        Where nomRecette= :tag_nomRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_nomRecette" => $nomRecette);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Ustensile');
            $t = $req_prep->fetchall();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }

    /*
     * ajouter une méthode qui permet de recuperer les commentaires d'un utilisateur
     */
    public static function getCommentaireByNumUtilisateur($numUtilisateur){
        $requetePreparee =
            "SELECT descriptionCommentaire, noteCommentaire
            FROM Commentaire 
            JOIN Recette ON(Commentaire.numRecette=Recette.numRecette)
            JOIN Utilisateur ON(Utilisateur.numUtillisateur=Commentaire.numUtillisateur)
            Where Utilisateur.numUtilisateur = :tag_numUtilisateur";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numUtilisateur" => $numUtilisateur);
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

    public static function getCommentaireByNumRecette($numRecette){
        $requetePreparee =
            "SELECT descriptionCommentaire, noteCommentaire
            FROM Commentaire 
            JOIN Recette ON(Commentaire.numRecette=Recette.numRecette)
            JOIN Utilisateur ON(Utilisateur.numUtillisateur=Commentaire.numUtillisateur)
            Where Recette.numRecette = :tag_numRecette";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
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

}
?>