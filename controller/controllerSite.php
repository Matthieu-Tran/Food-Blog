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
    public static function acceuil()
    {
        $lesRecettes = Recette::getAllRecettes();
        require_once("./view/acceuil.php");
    }

    public static function readAll()
    {
        $lesRecettes = Recette::getAllRecettes();
        $title = "Recettes";
        require("view/list.php");
    }

    public static function read()
    {
        $numRecette = $_GET["numRecette"];
        $recette = Recette::getRecettesbyNumRecette($numRecette);
        $lienRetour = '<a href="routeur.php?action=readAll">retour à la liste</a>';
        $title = "Une recette";
        require("view/details.php");
    }

    public static function create()
    {
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
        if ($recette == null) {
            Recette::addRecette($nomRecette, $difficulteRecette, $descriptionRecette, $numUtilisateur);
            echo "Recette ajoute";
        } else {
            $uneRecette = Recette::getRecettesbyNumRecette($recette[0]);
            $uneRecette->affichage();
            echo "Recette déja crée par un membre";
        }
        self::acceuil();
    }

    public static function delete()
    {
        $numRecette = $_GET["numRecette"];
        Recette::deleteRecette($numRecette);
        self::acceuil();
    }

    public static function update()
    {
        $numRecette = $_GET["numRecette"];
        $recette = Recette::getRecettesbyNumRecette($numRecette);
        $nomRecette = $recette->getnomRecette();
        $difficulteRecette = $recette->getdifficulteRecette();
        $descriptionRecette = $recette->getdifficulteRecette();
        $utilisateur = $recette->getfkNumUtilisateur();
        $title = "mise à jour d'une recette";
        require("view/update.php");
    }

    public static function updated()
    {
        $nomRecette = $_GET["nomRecette"];
        $difficulteRecette = $_GET["difficulteRecette"];
        $descriptionRecette = $_GET["descriptionRecette"];
        $recette = Recette::updateRecette($nomRecette, $difficulteRecette, $descriptionRecette);
        self::acceuil();
    }

    public static function search()
    {
        $uneRecette = Recette::getAllRecettes();
        $title = "recherche d'une Recette";
        require("view/search.php");
    }

    public static function found()
    {
        $numRecette = $_GET["numRecette"];
        $laRecette = Recette::rechercherRecette($numRecette);
        $title = "La recette";
        require("view/found.php");
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
                if (password_verify($password, $data['mdpUtilsateur'])) {
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
                                // On redirige avec le message de succès
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

    public static function afficherRecette()
    {
        //Pour avoir le nom de la recette
        $numRecette = ($_GET['numRecette']);
        $ArrayNomRecette = Recette::getNomRecettebyNumRecette($numRecette);
        $nomRecette = $ArrayNomRecette['nomRecette'];

        //Pour avoir la difficulte de la recette
        $ArrayDiffRecette = Recette::getDifficultebyNumRecette($numRecette);
        $difficulteRecette = $ArrayDiffRecette['difficulteRecette'];

        //Pour avoir les instructions de la recette
        $ArrayInstruction = Recette::getInstructionbyNumRecette($numRecette);
        $instructionRecette = $ArrayInstruction['descriptionRecette'];

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
        } else
            $nbIngredientRecette = 0;

        require_once("./view/afficher.php");
    }
}
