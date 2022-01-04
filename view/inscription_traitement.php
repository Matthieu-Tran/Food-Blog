<?php
    require_once("conf/Connexion.php");

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty(!empty($_POST['Prénom']) && !empty($_POST['Nom']) && $_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_retype']) ) {
        // Patch XSS
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $nom = htmlspecialchars($_POST['Nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);
        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mdpUtilisateur FROM utilisateurs WHERE pseudoUtilisateur = ?');
        $check->execute(array($pseudo));
        $data = $check->fetch();
        $row = $check->rowCount();
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
        if ($row == 0) {
            if (strlen($pseudo) <= 100) { // On verifie que la longueur du pseudo <= 100
                if ($password === $password_retype) { // si les deux mdp saisis sont bon
                    // On hash le mot de passe avec Bcrypt, via un coût de 12
                    $cost = ['cost' => 12];
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT, $cost);
                    // On insère dans la base de données

                    $insert = $bdd->prepare('INSERT INTO Utilisateur (numUtilisateur, nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mdpUtilsateur, banUtilisateur) VALUES (NULL, :nomUtilisateur, :prenomUtilisateur, :pseudoUtilisateur, :mdpUtilsateur, 0);');
                    $insert->execute(array(
                        'nomUtilisateur' => $nom,
                        'prenomUtilisateur' => $prenom,
                        'pseudoUtilisateur' => $pseudo,
                        'mdpUtilsateur' => $passwordHash,
                        'token' => bin2hex(openssl_random_pseudo_bytes(64))
                    ));
                    // On redirige avec le message de succès
                    header('inscription.php?reg_err=success');
                    die();
                }
                else{
                        header('inscription.php?reg_err=password');
                        die();
                    }
                } else {
                    header('inscription.php?reg_err=pseudo_length');
                    die();
                }
            } else {
                header('inscription.php?reg_err=already');
                die();
            }
    }
?>