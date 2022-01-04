<?php
    require_once("conf/Connexion.php");
    Connexion::connect();
    var_dump($_POST);
    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty(!empty($_POST['Prenom']) && !empty($_POST['Nom']) && $_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_retype']) ) {
        // Patch XSS
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $nom = htmlspecialchars($_POST['Nom']);
        $prenom = htmlspecialchars($_POST['Prenom']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);
        // On vérifie si l'utilisateur existe
        //$check = Connexion::pdo()->prepare('SELECT nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mdpUtilisateur FROM Utilisateur WHERE pseudoUtilisateur = ?');
        $requetePreparee = "SELECT * from Utilisateur where pseudoUtilisateur = :tag_pseudo;";
        $valeurs = array("tag_pseudo" => $pseudo);

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
                    $insert = Connexion::pdo()->prepare('INSERT INTO Utilisateur (numUtilisateur, nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mdpUtilsateur, banUtilisateur) VALUES (NULL, :nomUtilisateur, :prenomUtilisateur, :pseudoUtilisateur, :mdpUtilsateur, 0);');
                    $insert->execute(array(
                        'nomUtilisateur' => $nom,
                        'prenomUtilisateur' => $prenom,
                        'pseudoUtilisateur' => $pseudo,
                        'mdpUtilsateur' => $passwordHash,
                    ));
                    echo "ca marche";
                    // On redirige avec le message de succès
                    //header('Location: google.com');
                    //die();
                }
                else{
                    echo "Ca marche pas";
                        //header('Location: inscription.php?reg_err=password');
                        //die();
                    }
                } else {
                    echo "Ca marche pas";
                    //header('Location: inscription.php?reg_err=pseudo_length');
                    //die();
                }
            } else {
                echo "Ca marche pas";
                //header('Location: inscription.php?reg_err=already');
                //die();
            }
    }
?>