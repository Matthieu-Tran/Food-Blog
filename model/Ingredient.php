<?php
require_once("conf/Connexion.php");
Connexion::connect();
class Ingredient
{
    private $pkNumIngredient;
    private $nomIngredient;
    private $fkNumFamille;
    private $fkQuantite;

    public function getPkNumIngredient()
    {
        return $this->pkNumIngredient;
    }

    public function getNomIngredient()
    {
        return $this->nomIngredient;
    }

    public function getFkNumFamille()
    {
        return $this->fkNumFamille;
    }

    public function getFkQuantite()
    {
        return $this->fkQuantite;
    }

    public function __construct($pkNumIngredient = NULL, $nomIngredient = NULL, $fkNumFamille = NULL, $fkQuantite = NULL)
    {
        if (!is_null($pkNumIngredient)) {
            $this->pkNumIngredient = $pkNumIngredient;
            $this->nomCategorie = $nomIngredient;
            $this->fkNumFamille = $fkNumFamille;
            $this->fkQuantite = $fkQuantite;
        }
    }
    /*
     * Méthode qui donne numIngredient par le numRecette
     */


    public static function getAllIngredient()
    {
        $requete = "SELECT * FROM Ingredient ORDER BY nomIngredient;";
        $reponse = Connexion::pdo()->query($requete);
        //$reponse->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
        $tab = $reponse->fetchAll();
        return $tab;
    }

    public static function getAllIngredientByNumRecette($numRecette)
    {
        $requetePreparee = "SELECT R.nomRecette, I.nomIngredient, F.nomFamille
        FROM compose C 
        JOIN Ingredient I ON(C.numIngredient=I.numIngredient)
        JOIN Recette R ON(R.numRecette=C.numRecette)
        JOIN Famille F ON(I.numFamille=F.numFamille)
        WHERE C.numRecette = :tag_numRecette;";
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

    public static function getAllNumIngredientByNumRecette($numRecette)
    {
        $requetePreparee = "SELECT numIngredient FROM Ingredient ORDER BY nomIngredient WHERE numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
            $tab = $req_prep->fetchall();
            if (!$tab)
                return false;
            return $tab;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    public static function rechercherIngredient($nomIngredient)
    {
        $requetePreparee = "SELECT nomIngredient FROM Ingredient where  nomIngredient like '%:tag_nomIngredient%';";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_nomIngredient" => $nomIngredient);
        try {
            $req_prep->execute($valeurs);
            $t = $req_prep->fetchAll();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }
}
