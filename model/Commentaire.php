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

    public function getpkNumCommentaire()
    {
        return $this->pkNumCommentaire;
    }
    public function getNoteCommentaire()
    {
        return $this->noteCommentaire;
    }
    public function getAlerteCommentaire()
    {
        return $this->alerteCommentaire;
    }
    public function getfkNumRecette()
    {
        return $this->fkNumRecette;
    }
    public function getfkNumUtilisateur()
    {
        return $this->fkNumUtilsateur;
    }

    public function __construct($numCom = NULL, $noteCom = NULL, $alertCom = NULL, $numRec = NULL, $numUtil = NULL)
    {
        if (!is_null($numCom)) {
            $this->pkNumCommentaire = $numCom;
            $this->noteCommentaire = $noteCom;
            $this->alerteCommentaire = $alertCom;
            $this->fkNumRecette = $numRec;
            $this->fkNumUtilsateur = $numUtil;
        }
    }

    public static function getCommentaireByNumRecette($numRecette)
    {
        $requetePreparee =
            "SELECT *
            FROM Commentaire 
            Where numRecette = :tag_numRecette";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            $tab = $req_prep->fetchall();
            if (!$tab)
                return false;
            return $tab;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    public static function ajoutCommentaireByUser($descriptionCommentaire, $noteCommentaire, $alerteCommentaire, $fkNumRecette, $fkNumUtilsateur)
    {
        $requetePreparee = "INSERT INTO Commentaire (descriptionCommentaire,noteCommentaire,alerteCommentaire,numRecette, numUtilisateur) VALUES(:tag_descriptionCommentaire,:tag_noteCommentaire,:tag_alerteCommentaire,:tag_fkNumRecette, :tag_fkNumUtilsateur);";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array(
            "tag_descriptionCommentaire" => $descriptionCommentaire,
            "tag_noteCommentaire" => $noteCommentaire,
            "tag_alerteCommentaire" => $alerteCommentaire,
            "tag_fkNumRecette" => $fkNumRecette,
            "tag_fkNumUtilsateur" => $fkNumUtilsateur,
        );
        try {
            $req_prep->execute($valeurs);
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
    }

    public static function deleteCommentaire($numCommentaire)
    {
        $requetePreparee = "DELETE FROM Commentaire WHERE numCommentaire = :tag_numCommentaire;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numCommentaire" => $numCommentaire);
        try {
            $req_prep->execute($valeurs);
            return true;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }


    public static function filtrageCommentaire($commentaire)
    {
        $requete = "SELECT * FROM black_list";
        $reponse = Connexion::pdo()->query($requete);
        $tab = $reponse->fetchAll();
        foreach ($tab as $key => $val) {
            if ((strpos(($tab[$key]['nomInsulte']), $commentaire)) !== false)
                return true;
        }
        return false;
    }
}
