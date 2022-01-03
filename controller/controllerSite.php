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
        require_once("./view/header.html");
        require_once("./view/acceuil.php");
    }

    public static function createdRecette()
    {
        $lesRecettes = Recette::getAllRecette();
        extract($_GET);
        if (!in_array($nomRecette, $lesRecettes)) {
            Recette::addRecette($nomRecette, $difficulteRecette, $descriptionRecette, $numUtilisateur);
            echo "Recette ajoute";
        } else {
            $numRecette = getNumRecettebyNomRecette($nomRecette);

            /*
             * Ajouter un href qui va pointer vers la recette
             */
            echo "Recette déja crée par un membre";
        }
        self::acceuil();
    }
}