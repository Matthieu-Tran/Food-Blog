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
        $reponse->setFetchMode(PDO::FETCH_CLASS,'Famille');
        $tab = $reponse->fetchAll();
        return $tab;
    }
}
