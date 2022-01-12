<?php
require_once("conf/Connexion.php");
Connexion::connect();
class Categorie
{
    private $numCategorie;
    private $nomCategorie;
    private $typeCategorie;
    private $coherenceCategorie;

    public function getPkNumCategorie()
    {
        return $this->pkNumCategorie;
    }

    public function getNomCategorie()
    {
        return $this->nomFamille;
    }

    public function getTypeCategorie()
    {
        return $this->typeCategorie;
    }

    public function getCoherenceCategorie()
    {
        return $this->coherenceCategorie;
    }

    public function __construct($pkNumCategorie = NULL, $nomCategorie = NULL, $typeCategorie = NULL)
    {
        if (!is_null($pkNumCategorie)) {
            $this->numCategorie = $pkNumCategorie;
            $this->nomCategorie = $nomCategorie;
            $this->typeCategorie = $typeCategorie;
            $this->coherenceCategorie = true;
        }
    }

    public static function getAllCategorie()
    {
        $requete = "SELECT * FROM Categorie ORDER BY numCategorie;";
        $reponse = Connexion::pdo()->query($requete);
        $tab = $reponse->fetchAll();
        return $tab;
    }

    public static function getCategorieByNumRecette($numRecette)
    {
        $requetePreparee = "SELECT R.nomRecette, C.nomCategorie, C.typeCategorie 
        FROM appartient A 
        JOIN Categorie C ON(A.numCategorrie=C.numCategorrie) 
        JOIN Recette R ON(R.numRecette=A.numRecette)
        WHERE numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numIngredient" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }
}
