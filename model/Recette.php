<?php
    require_once("conf/Connexion.php");
    Connexion::connect();
class Recette
{
    private $numRecette;
    private $nomRecette;
    private $difficulteRecette;
    private $descriptionRecette;
    private $numUtilisateur;

    public function getnumRecette(){return $this->numRecette;}
    public function getnomRecette(){return $this->nomRecette;}
    public function getdifficulteRecette(){return $this->difficulteRecette;}
    public function getdescriptionRecette(){return $this->descriptionRecette;}
    public function getnumUtilisateur(){return $this->numUtilisateur;}

    public function __construct($numR = NULL,$nomR = NULL,$difR = NULL,$desR = NULL,$numU = NULL)  {
        if (!is_null($numR)) {
            $this->numRecette = $numU;
            $this->nomRecette = $nomR;
            $this->difficulteRecette = $difR;
            $this->descriptionRecette = $desR;
            $this->numUtilisateur = $numU;
        }
    }
    public function affichage() {
        return "<p>Recette [numRecette = $this->numRecette, nomRecette = $this->nomRecette]</p>";
    }

    public static function getAllRecettes() {
        $requete = "SELECT * FROM Recette ORDER BY NumRecette;";
        $reponse = Connexion::pdo()->query($requete);
        $reponse->setFetchMode(PDO::FETCH_CLASS,'Recette');
        $tab = $reponse->fetchAll();
        return $tab;
    }
    public static function getNumRecettebyNomRecette($nomRecette)
    {
        $requetePreparee = "SELECT numRecette FROM Recette where nomRecette = :tag_nomRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_nomRecette" => $nomRecette);
        try {
            $req_prep->execute($valeurs);
            //$req_prep->setFetchMode(PDO::FETCH_CLASS,'Recette');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }

    public static function getRecettesbyNumUtilisateur($numUtilisateur)
    {
        $requetePreparee = "SELECT nomRecette FROM Recette where numUtilisateur = :tag_numUtilisateur;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numUtilisateur" => $numUtilisateur);
        try {
            $req_prep->execute($valeurs);
            //$req_prep->setFetchMode(PDO::FETCH_CLASS,'Recette');
            $t = $req_prep->fetchall();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }

    public static function getRecettesbyNumRecette($numRecette)
    {
        $requetePreparee = "SELECT * FROM Recette where numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
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

    public static function getRecetteByNumCommentaire($numCommentaire){
        $requetePreparee =
            "SELECT nomRecette
            FROM Recette 
            JOIN Commentaire ON(Commentaire.numRecette=Recette.numRecette)
            JOIN Utilisateur ON(Utilisateur.numUtilisateur=Commentaire.numUtilisateur)
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


    public static function updateRecette($nomRecette,$difficulteRecette,$descriptionRecette) {
        $requetePreparee = "UPDATE Recette SET difficulteRecette = :tag_difficulteRecette, descriptionRecette = :tag_descriptionRecette WHERE nomRecette = :tag_nomRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array(
            "tag_difficulteRecette" => $difficulteRecette,
            "tag_descriptionRecette" => $descriptionRecette,
            "tag_nomRecette" => $nomRecette
        );
        try {
            $req_prep->execute($valeurs);
            return true;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
            return false;
        }
    }

    public static function addRecette($nomRecette,$difficulteRecette,$descriptionRecette,$numUtilisateur) {
        $requetePreparee = "INSERT INTO Recette (nomRecette,difficulteRecette,descriptionRecette,numUtilisateur) VALUES(:tag_nomRecette,:tag_difficulteRecette,:tag_descriptionRecette,:tag_numUtilisateur);";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array(
            "tag_nomRecette" => $nomRecette,
            "tag_difficulteRecette" => $difficulteRecette,
            "tag_descriptionRecette" => $descriptionRecette,
            "tag_numUtilisateur" => $numUtilisateur
        );
        try {
            $req_prep->execute($valeurs);
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
    }

    public static function deleteRecette($numRecette) {
        $requetePreparee = "DELETE FROM Recette WHERE numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
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
    public static function rechercherRecette($nomRecette){
        $requetePreparee = "SELECT nomRecette,difficulteRecette,descriptionRecette FROM Recette where nomRecette = :tag_nomRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_nomRecette" => $nomRecette);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Recette');
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
?>