<?php

use function PHPSTORM_META\type;

require_once("model/Categorie.php");
require_once("model/Commentaire.php");
require_once("model/Famille.php");
require_once("model/Ingredient.php");
require_once("model/Recette.php");
require_once("model/Ustensile.php");
require_once("model/Utilisateur.php");

class controllerSite
{
    public static function acceuil()
    {
        $lesRecettes = Recette::getAllRecettes();
        require_once("./view/acceuil.php");
    }
    public static function create()
    {
        $oubliUstensile = false;
        $oubliIngredient = false;
        if (isset($_GET["oubliUstensile"])) {
            $oubliUstensile = true;
        }
        if (isset($_GET["oubliIngredient"])) {
            $oubliIngredient = true;
        }
        if (isset($_GET["oubliIngredient"]) && isset($_GET["oubliUstensile"])) {
            $oubliIngredient = true;
            $oubliUstensile = true;
        }
        $pseudo = $_SESSION['user'];
        $listeNumUtilisateur = Utilisateur::getNumUtilisateurbyPseudoUtilisateur($pseudo);
        $numUti = $listeNumUtilisateur['numUtilisateur'];
        // les catégories
        $lesCategories = Categorie::getAllCategorie();
        // les Ustensiles
        $lesUstensiles = Ustensile::getAllUstensile();
        // les familles
        $lesFamilles = Famille::getAllFamille();
        //Les recettes
        $lesRecettes = Recette::getAllRecettes();
        //Les Ingredients
        $lesIngredients = Ingredient::getAllIngredient();

        $title = "création d'une Recette";
        require("view/create.php");
    }

    public static function created()
    {
        extract($_POST);
        $recette = Recette::getNumRecettebyNomRecette($nomRecette);
        if ($recette == null && $numIngredient[0] != 0 && $numUstensile[0] != 0) {
            if (isset($_FILES['photo']['tmp_name'])) {
                $retour = copy($_FILES['photo']['tmp_name'], 'view/image/' . $_FILES['photo']['name']);
                $nomImage = $_FILES['photo']['name'];
            }
            Recette::addRecette($nomRecette, $difficulteRecette, $descriptionRecette, $_SESSION['numUtilisateur'], $nomImage);
            $leNumRecette = Recette::getNumRecettebyNomRecette($nomRecette);
            $leNumRecette = $leNumRecette['numRecette'];
            Recette::addRecetteAppartient($numCategorie, $leNumRecette);
            foreach ($numIngredient as $key => $value) {
                if ($numIngredient[$key] == 0 || is_null($quantite[$key]))
                    continue;
                Recette::addRecetteCompose($leNumRecette, $numIngredient[$key], $quantite[$key]);
            }
            foreach ($numUstensile as $key => $value) {
                if ($numUstensile[$key] == 0)
                    continue;
                Recette::addRecetteUstensile($leNumRecette, $numUstensile[$key]);
            }
            header("Location: routeur.php?action=afficherRecette&numRecette=$leNumRecette");
        } else if ($numUstensile[0] == 0 && $numIngredient[0] == 0) {
            header("Location: routeur.php?action=create&oubliIngredient=true&oubliUstensile=true");
        } else if ($numUstensile[0] == 0 && $numIngredient[0] != 0) {
            header("Location: routeur.php?action=create&oubliUstensile=true");
        } else if ($numIngredient[0] == 0 && $numUstensile[0] != 0) {
            header("Location: routeur.php?action=create&oubliIngredient=true");
        } else {
            header("Location: routeur.php?action=afficherRecette&numRecette=$recette[0]&recetteExistante=true");
        }
    }

    public static function rechercher()
    {
        $nomRecette = $_GET["inputClient"];
        $lesRecettes = Recette::rechercherRecette($nomRecette);
        require("./view/search.php");
    }

    public static function seConnecter()
    {
        require_once("./view/Connexion/pageConnexion.php");
    }
    public static function connection_traitement()
    {
        if (!empty($_POST["rememberme"])) {
            setcookie("username", $_POST["Pseudo"], time() + 86400); // on set les cookies a un jour 86400
        } else {
            setcookie("username", null, time() - 1);
        }
        if (!empty($_POST['Pseudo']) && !empty($_POST['password'])) // Si il existe les champs Pseudo, password et qu'ils sont pas vide
        {
            // Patch XSS
            $Pseudo = htmlspecialchars($_POST['Pseudo']);
            $password = htmlspecialchars($_POST['password']);
            $Pseudo = strtolower($Pseudo); // Pseudo transformé en minuscule
            // On regarde si l'utilisateur est inscrit dans la table utilisateurs
            $requete = Utilisateur::getAllUtilisateurbyPseudo($Pseudo);
            $data = $requete->fetch();
            $row = $requete->rowCount();
            // Si > à 0 alors l'utilisateur existe
            if ($row > 0) {
                if (password_verify($password, $data['mdpUtilisateur'])) {
                    $_SESSION['user'] = $data['pseudoUtilisateur'];
                    header('Location: routeur.php?action=acceuil');
                } else {
                    setcookie("mdpDif", $_POST["Pseudo"], time() + 5);    // si l'utilisateur se trompe de mot de passe mais que le pseudo est bon on initialise un cookie pour sauvegarder le pseudo de l'utilisateur
                    header('Location: routeur.php?action=seConnecter&login_err=password');
                    die();
                }
            } else {
                header('Location: routeur.php?action=seConnecter&login_err=Pseudo');
                die();
            }
        } else {
            header('Location: routeur.php?action=seConnecter&login_err=Pseudo');
            die();
        } // si le formulaire est envoyé sans aucune données

    }
    public static function inscription()
    {
        require_once("./view/inscription/inscription.php");
    }
    public static function inscription_traitement()
    {
        // Si les variables existent et qu'elles ne sont pas vides
        if (!empty(!empty($_POST['Prenom']) && !empty($_POST['Nom']) && $_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) {
            // Patch XSS
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $nom = htmlspecialchars($_POST['Nom']);
            $prenom = htmlspecialchars($_POST['Prenom']);
            $password = htmlspecialchars($_POST['password']);
            $password_retype = htmlspecialchars($_POST['password_retype']);
            // On vérifie si l'utilisateur existe

            $requete = Utilisateur::getAllUtilisateurbyPseudo($pseudo);
            $row = $requete->rowCount();

            // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
            if ($row == 0) {
                if (strlen($prenom) <= 50) {
                    if (strlen($nom) <= 50) {
                        if (strlen($pseudo) <= 20) { // On verifie que la longueur du pseudo <= 100
                            if ($password === $password_retype) { // si les deux mdp saisis sont bon
                                // On hash le mot de passe avec Bcrypt, via un coût de 12
                                $cost = ['cost' => 12];
                                $passwordHash = password_hash($password, PASSWORD_BCRYPT, $cost);
                                // On insère dans la base de données
                                Utilisateur::addUtilisateur($nom, $prenom, $pseudo, $passwordHash);
                                $numUtiInscription = Utilisateur::getNumUtilisateurbyPseudoUtilisateur($pseudo);
                                // On redirige avec le message de succès
                                $_SESSION['numUtilisateur'] = $numUtiInscription['numUtilisateur'];
                                $_SESSION['user'] = $pseudo;
                                header('Location: routeur.php?action=acceuil');
                                die();
                            } else {
                                setcookie("pseudonyme", $_POST["pseudo"], time() + 5);
                                setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
                                setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
                                header('Location: routeur.php?action=inscription&reg_err=password');
                                die();
                            }
                        } else {
                            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
                            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
                            header('Location: routeur.php?action=inscription&reg_err=pseudo_length');
                            die();
                        }
                    } else {
                        setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
                        setcookie("pseudonyme", $_POST["pseudo"], time() + 5);
                        header('Location: routeur.php?action=inscription&reg_err=nom_length');
                        die();
                    }
                } else {
                    setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
                    setcookie("pseudonyme", $_POST["pseudo"], time() + 5);
                    header('Location: routeur.php?action=inscription&reg_err=prenom_length');
                    die();
                }
            } else {
                setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
                setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
                header('Location: routeur.php?action=inscription&reg_err=already');
                die();
            }
        }
    }
    public static function deconnexion()
    {
        session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
        header('Location: routeur.php?action=acceuil'); // On redirige
        die();
    }
    public static function afficherRecetteUtilisateur()
    {
        $numUtilisateurRecette = $_SESSION['numUtilisateur'];
        $lesRecettesUtilisateurs = Recette::getAllRecettesbyNumUtilisateur($numUtilisateurRecette);
        require("./view/afficherRecetteUtilisateur.php");
    }

    public static function afficherRecette()
    {
        $recetteExistante = false;
        if (isset($_GET['recetteExistante'])) {
            $recetteExistante = true;
        }

        $numRecette = $_GET['numRecette'];

        // On recupere la recette
        $tabNomRecette = Recette::getRecettesbyNumRecette($numRecette);

        //Pour avoir le nom de la recette
        $nomRecette = $tabNomRecette['nomRecette'];

        //Pour avoir le nom de l'image
        $nomRecetteImage = $tabNomRecette['imageRecette'];


        //Pour avoir la difficulte de la recette
        $difficulteRecette = $tabNomRecette['difficulteRecette'];

        //Pour avoir les instructions de la recette
        $instructionRecette = $tabNomRecette['descriptionRecette'];

        //Pour voir les ustensiles de la recette
        $listeNomUstensile = array();
        if ($listeUstensiles = Recette::rechercherUstensile($numRecette)) {
            foreach ($listeUstensiles as $key => $value) {
                $nomUstensile = Ustensile::getNomUstensileByNumUstensile($listeUstensiles[$key]['numUstensile']);
                array_push($listeNomUstensile, $nomUstensile);
            }
        }
        //Pour voir les ingredients et quantite de la recette
        $listeQuantite = Recette::getQuantiteIngredients($numRecette);
        if ($listeIngredient = Ingredient::getAllIngredientByNumRecette($numRecette)) {
            $nbIngredientRecette = count($listeIngredient);
        } else {
            $nbIngredientRecette = 0;
        }

        $commentaires = "";
        $sommmeCommentaires = 0;
        $nbCommentaires = 0;
        $nb1 = 0;
        $nb2 = 0;
        $nb3 = 0;
        $nb4 = 0;
        $nb5 = 0;

        // Faire condition lorsqu'une recette n'a pas de commentaire
        $commentaires = Commentaire::getCommentaireByNumRecette($numRecette);
        if (is_bool($commentaires)) {
            $existeCommentaire = false;
        } else {
            $existeCommentaire = true;
            foreach ($commentaires as $key => $val) {
                $sommmeCommentaires += $commentaires[$key]['noteCommentaire'];
                $nbCommentaires++;
                switch ($commentaires[$key]['noteCommentaire']) {
                    case 1:
                        $nb1++;
                        break;
                    case 2:
                        $nb2++;
                        break;
                    case 3:
                        $nb3++;
                        break;
                    case 4:
                        $nb4++;
                        break;
                    case 5:
                        $nb5++;
                        break;
                }
            }
            $pourcentage1 = round((($nb1 / $nbCommentaires) * 100), 2);
            $pourcentage2 = round((($nb2 / $nbCommentaires) * 100), 2);
            $pourcentage3 = round((($nb3 / $nbCommentaires) * 100), 2);
            $pourcentage4 = round((($nb4 / $nbCommentaires) * 100), 2);
            $pourcentage5 = round((($nb5 / $nbCommentaires) * 100), 2);
            $moyenneCommentaire = $sommmeCommentaires / $nbCommentaires;
        }
        require_once("./view/afficher.php");
    }


    public static function ajoutCommentaire()
    {
        $pseudo = $_SESSION['user'];
        $listeNumUtilisateur = Utilisateur::getNumUtilisateurbyPseudoUtilisateur($pseudo);
        //On recupere dans la list, le numero d'utilisateur
        $numUtili = $listeNumUtilisateur['numUtilisateur'];
        //On extract les donnes recuperees en GET
        extract($_GET);
        $alerteCommentaire = 0;
        //On filtre le commentaire de l'utilisateur
        if (Commentaire::filtrageCommentaire($user_review)) {
            if (Utilisateur::alerteUtilisateur($listeNumUtilisateur['numUtilisateur'])) {
                //Si l'utilisateur a depasse son nombre d'avertissement, on le supprime
                Utilisateur::deleteUtilisateur($listeNumUtilisateur['numUtilisateur']);
                session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
                header('Location: routeur.php?action=acceuil&ban=aurevoir:)'); // On redirige
                die();
            } else
                //Sinon on lui redirige avec un message d'alerte
                header("Location: routeur.php?action=afficherRecette&numRecette=$numRecette&com_warning=ATTENTION");
        } else {
            //On ajoute le commentaire a la recette
            Commentaire::ajoutCommentaireByUser($user_review, $user_rating, $alerteCommentaire, $numRecette, $numUtili);
            header("Location: routeur.php?action=afficherRecette&numRecette=$numRecette");
        }
    }
    public static function supprimerCommentaire()
    {
        extract($_GET);
        Commentaire::deleteCommentaire($numCommentaire);
        header("Location: routeur.php?action=afficherRecette&numRecette=$numRecette");
    }
}
