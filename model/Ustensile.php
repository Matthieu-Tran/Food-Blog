<?php

class Ustensile
{
    private $pkNumUstensile;
    private $nomUstensile;
    public function __construct($numU = NULL,$nomU = NULL)  {
        if (!is_null($numU)) {
            $this->pkNumUstensile = $numU;
            $this->pkNumUstensile = $nomU;
        }
    }
    public function getNomUstensile() {return $this->nomUstensile;}
    public function getNumUstensile() {return $this->numUstensile;}

    public static function getAllUstensile() {
        $requete = "SELECT * FROM Ustensile ORDER BY nomUstensile;";
        $reponse = Connexion::pdo()->query($requete);
        $reponse->setFetchMode(PDO::FETCH_CLASS,'Ustensile');
        $tab = $reponse->fetchAll();
        return $tab;
    }

    public static function getUstensileByNumRecette($numRecette) {
        $requetePreparee =
        "Select DISTINCT nomUstensile
        FROM Ustensile U
        JOIN utilise uT ON(U.numUstensile=uT.numUstensile) 
        JOIN Recette R ON(uT.numRecette=R.numRecette) 
        Where numRecette= :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,'Ustensile');
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