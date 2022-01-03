<?php
    session_start(); // Démarrage de la session
    require_once("conf/Connexion.php"); // On inclut la connexion à la base de données

    if(!empty($_POST['pseudo']) && !empty($_POST['password'])) // Si il existe les champs pseudo, password et qu'il sont pas vide
    {
        // Patch XSS
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);

        $pseudo = strtolower($pseudo); // pseudo transformé en minuscule

        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT numUtilisateur, nomUtilisateur, prenomUtilisateur, pseudoUtilisateur FROM utilisateur WHERE pseudo = ?');
        $check->execute(array($pseudo));
        $data = $check->fetch();
        $row = $check->rowCount();

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            $password = hash('sha256', password);
            if($data['password'] === $password){
                $_SESSION['user'] = $data['pseudo'];
                header('Location:landing.php');
            }else{ header('Location:pageConnexion.php?login_err=password'); die();}
        }else{ header('Location: index.php?login_err=already'); die(); }
    }else{ header('Location: index.php'); die();} // si le formulaire est envoyé sans aucune données

?>