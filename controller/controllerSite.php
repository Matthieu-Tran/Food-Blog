<?php
require_once("model/Categorie.php");
require_once("model/Commentaire.php");
require_once("model/Famille.php");
require_once("model/Ingredient.php");
require_once("model/Recette.php");
require_once("model/Ustensile.php");
require_once("model/Utilisateur.php");
class controllerSite
{
    public static function acceuil(){
        $lesRecettes = Recette::getAllRecettes();
        require_once("./view/acceuil.php");
        require("./view/head.php");
    }

    public static function readAll() {
        $lesRecettes = Recette::getAllRecettes();
        $title = "Recettes";
        require("view/head.php");
        require("view/list.php");
    }

    public static function read() {
        $numRecette = $_GET["numRecette"];
        $recette = Recette::getRecettesbyNumRecette($numRecette);
        $lienRetour = '<a href="routeur.php?action=readAll">retour à la liste</a>';
        $title = "Une recette";
        require("view/head.php");
        require("view/details.php");
    }

    public static function create() {
        $title = "création d'une Recette";
        require("view/head.php");
        require("view/create.php");
    }

    public static function created() {
        $lesRecettes = Recette::getAllRecettes();
        extract($_GET);
        $recette = Recette::getNumRecettebyNomRecette($nomRecette);
        $test = Recette::getRecettesbyNumUtilisateur($numUtilisateur);
        echo "<pre>";
        print_r($test);
        echo "</pre>";
        echo "<pre>";
        print_r($recette);
        echo "</pre>";
        if($recette == null){
            Recette::addRecette($nomRecette, $difficulteRecette, $descriptionRecette, $numUtilisateur);
            echo "Recette ajoute";
        } else {
            $uneRecette = Recette::getRecettesbyNumRecette($recette[0]);
            $uneRecette->affichage();
            echo "Recette déja crée par un membre";
        }
        self::acceuil();
    }

    public static function delete() {
        $numRecette = $_GET["numRecette"];
        Recette::deleteRecette($numRecette);
        self::acceuil();
    }

    public static function update() {
        $numRecette = $_GET["numRecette"];
        $recette = Recette::getRecettesbyNumRecette($numRecette);
        $nomRecette = $recette->getnomRecette();
        $difficulteRecette = $recette->getdifficulteRecette();
        $descriptionRecette = $recette->getdifficulteRecette();
        $utilisateur = $recette->getfkNumUtilisateur();
        $title = "mise à jour d'une recette";
        require("view/head.php");
        require("view/update.php");
    }

    public static function updated() {
        $nomRecette = $_GET["nomRecette"];
        $difficulteRecette = $_GET["difficulteRecette"];
        $descriptionRecette = $_GET["descriptionRecette"];
        $recette = Recette::updateRecette($nomRecette,$difficulteRecette,$descriptionRecette);
        self::acceuil();
    }

    public static function search() {
        $uneRecette = Recette::getAllRecettes();
        $title = "recherche d'une Recette";
        require("view/head.php");
        require("view/search.php");
    }

    public static function found() {
        $numRecette = $_GET["numRecette"];
        $laRecette = Recette::rechercherRecette($numRecette);
        $title = "La recette";
        require("view/head.php");
        require("view/found.php");
    }

    public static function seConnecter(){
        require_once("./view/Connexion/pageConnexion.php");
    }
    public static function connection_traitement(){
        require_once("./view/Connexion/connexion_traitement.php");
    }
    public static function inscription(){
        require_once("./view/inscription/inscription.php");
    }
    public static function inscription_traitement(){
        require_once("./view/inscription/inscription_traitement.php");
    }
    public static function deconnexion(){
        require_once("./view/Connexion/deconnexion.php");
    }
}