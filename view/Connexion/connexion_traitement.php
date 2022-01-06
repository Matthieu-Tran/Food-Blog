<?php
    //session_start(); // Démarrage de la session
    require_once("conf/Connexion.php"); // On inclut la connexion à la base de données
    Connexion::connect();
    if(!empty($_POST["rememberme"])) {
        setcookie ("username",$_POST["Pseudo"],time()+ 86400); // on set les cookies a un jour
    }
    else{
        setcookie ("username", null, time() - 1);
    }

    if(!empty($_POST['Pseudo']) && !empty($_POST['password'])) // Si il existe les champs Pseudo, password et qu'ils sont pas vide
    {
        // Patch XSS
        $Pseudo = htmlspecialchars($_POST['Pseudo']);
        $password = htmlspecialchars($_POST['password']);
        $Pseudo = strtolower($Pseudo); // Pseudo transformé en minuscule
        // On regarde si l'utilisateur est inscrit dans la table utilisateurs

        $requetePreparee = "SELECT * from Utilisateur where PseudoUtilisateur = :tag_Pseudo;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_Pseudo" => $Pseudo);
        $req_prep->execute($valeurs);
        $data = $req_prep->fetch();
        $row = $req_prep->rowCount();
        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            if(password_verify($password, $data['mdpUtilsateur'])){
                $_SESSION['user'] = $data['pseudoUtilisateur'];
                header('Location: routeur.php?action=acceuil');
            }else{
                setcookie ("mdpDif",$_POST["Pseudo"],time()+ 5);    // si l'utilisateur se trompe de mot de passe mais que le pseudo est bon on initialise un cookie pour sauvegarder le pseudo de l'utilisateur
                header('Location: routeur.php?action=seConnecter&login_err=password');
                die();
            }
        }else{
            header('Location: routeur.php?action=seConnecter&login_err=Pseudo');
            die();
        }
    }else{
        header('Location: routeur.php?action=seConnecter&login_err=Pseudo');
        die();
    } // si le formulaire est envoyé sans aucune données
?>