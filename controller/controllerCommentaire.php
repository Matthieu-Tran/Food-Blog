<?php
require_once("model/Commentaire.php");
class controllerCommentaire
{
    public static function read() {
        $nomRecette = $_GET["nomRecette"];
        $numRecette = getNumRecettebyNomRecette($nomRecette);
        $commentaire = Commentaire::getCommentaireByNomRecette($numRecette);
        $lienRetour = '<a href="routeur.php?action=readAll">retour à la liste</a>';
        $title = "Un commentaire";
        require("view/head.php");
        require("view/details.php");
    }

}