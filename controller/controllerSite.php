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
        require_once("./view/acceuil.php");
    }
}