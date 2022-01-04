<?php
    session_start(); // Démarrage de la session
    require_once("conf/Connexion.php"); // On inclut la connexion à la base de données
    Connexion::connect();

    /*echo "<pre>";
    print_r($_POST);
    echo "</pre>";*/

    if(!empty($_POST['Pseudo']) && !empty($_POST['password'])) // Si il existe les champs Pseudo, password et qu'ils sont pas vide
    {
        echo "test";
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
       /* echo "<pre>";
        print_r($data);
        echo "</pre>";*/

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            if(password_verify($password, $data['mdpUtilsateur'])){
                echo "ca marche";
                $_SESSION['user'] = $data['Pseudo'];
                header('Location: routeur.php?action=acceuil');
            }else{
                header('Location: routeur.php?action=seConnecter&login_err=password');
                die();
            }
        }else{
            header('Location: routeur.php?action=seConnecter&login_err=Pseudo');
            die();
        }
    }else{
        header('Location: ./view/Connexion/seConnecter');
        die();
    } // si le formulaire est envoyé sans aucune données
?>