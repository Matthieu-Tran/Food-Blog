<?php
    require_once("conf/Connexion.php");
    Connexion::connect();
class Famille
{
    private $pkNumFamille;
    private $nomFamille;

    public function getPkNumFamille(){
        return $this->pkNumFamille;
    }

    public function getNomFamille(){
        return $this->nomFamille;
    }

    public function __construct($pkNumFamille=NULL,$nomFamille=NULL){
        if(!is_null($pkNumFamille)){
            $this->pkNumFamille = $pkNumFamille;
            $this->nomFamille = $nomFamille;
        }
    }

    public static function getAllFamille() {
        $requete = "SELECT * FROM Famille ORDER BY nomFamille;";
        $reponse = Connexion::pdo()->query($requete);
        $reponse->setFetchMode(PDO::FETCH_CLASS,'Tache');
        $tab = $reponse->fetchAll();
        return $tab;
    }

    /*public static function getFamilleByNomIngredient($nomIngredient) {
        $requetePreparee = "SELECT I.nomIngredient, F.nomFamille
        FROM Ingredient I JOIN Famille F ON(I.numFamille=F.numFamille)
        GROUP BY I.numIngredient WHERE nomIngredient = :tag_nomIngredient;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_nomIngredient" => $nomIngredient);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Famille');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }*/

    public static function getFamilleByNumIngredient($numIngredient) {
        $requetePreparee = "SELECT F.nomFamille
        FROM Ingredient I JOIN Famille F ON(I.numFamille=F.numFamille)
        WHERE numIngredient = :tag_numIngredient;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numIngredient" => $numIngredient);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Famille');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : ".$e->getMessage()."<br>";
        }
        return false;
    }
}
?>