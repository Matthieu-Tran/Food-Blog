<?php
    require_once("conf/Connexion.php");
    Connexion::connect();
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
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_pseudo" => $pseudo);
        $req_prep->execute($valeurs);
        $data = $req_prep->fetch();
        $row = $req_prep->rowCount();
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
        if ($row == 0) {
            if (strlen($pseudo) <= 20){ // On verifie que la longueur du pseudo <= 100
                if ($password === $password_retype) { // si les deux mdp saisis sont bon
                    // On hash le mot de passe avec Bcrypt, via un coût de 12
                    $cost = ['cost' => 12];
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT, $cost);
                    // On insère dans la base de données
                    $insert = Connexion::pdo()->prepare('INSERT INTO Utilisateur (numUtilisateur, nomUtilisateur, prenomUtilisateur, pseudoUtilisateur, mdpUtilsateur, banUtilisateur) VALUES (NULL, :nomUtilisateur, :prenomUtilisateur, :pseudoUtilisateur, :mdpUtilsateur, 0);');
                    $valeur = array(
                        "nomUtilisateur" => $nom,
                        "prenomUtilisateur" => $prenom,
                        "pseudoUtilisateur" => $pseudo,
                        "mdpUtilsateur" => $passwordHash,
                    );
                    $insert->execute($valeur);
                    echo "hello 5";
                    // On redirige avec le message de succès
                    header('Location: routeur.php?action=acceuil');
                    die();
                }
                else{
                    setcookie ("pseudonyme",$_POST["pseudo"],time()+ 5);
                    setcookie ("nomUtilisateur",$_POST["Nom"],time()+ 5);
                    setcookie ("prenomUtilisateur",$_POST["Prenom"],time()+ 5);
                        header('Location: routeur.php?action=inscription&reg_err=password');
                        die();
                    }
                } else {
                    setcookie ("nomUtilisateur",$_POST["Nom"],time()+ 5);
                    setcookie ("prenomUtilisateur",$_POST["Prenom"],time()+ 5);
                    header('Location: routeur.php?action=inscription&reg_err=pseudo_length');
                    die();
                }
            } else {
                setcookie ("nomUtilisateur",$_POST["Nom"],time()+ 5);
                setcookie ("prenomUtilisateur",$_POST["Prenom"],time()+ 5);
                header('Location: routeur.php?action=inscription&reg_err=already');
                die();
            }
    }
?>