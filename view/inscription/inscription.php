<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="NoS1gnal"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="view/css/login-register.css"/>
    <title>Inscription</title>
</head>
<body>
<div class="login-form" style="min-height: 60vh">
    <?php
    if(isset($_GET['reg_err']))
    {
        $err = htmlspecialchars($_GET['reg_err']);
        switch($err)
        {
            case 'success':
                ?>
                <div class="alert alert-success">
                    <strong>Succès</strong> Inscription réussie !
                </div>
                <?php
                break;

            case 'password':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> Les deux mots de passe sont différents
                </div>
                <?php
                break;

            case 'pseudo_length':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> Pseudo trop long..
                </div>
            <?php
            case 'already':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> Compte déjà existant
                </div>
            <?php
        }
    }
    ?>
    <form action="routeur.php?action=inscription_traitement" method="post">
        <h2 class="text-center">Inscription</h2>
        <div class="form-group">
            <input type="text" name="Prenom" class="form-control" placeholder="Prenom" value="<?php if(isset($_COOKIE["prenomUtilisateur"])) { echo $_COOKIE["prenomUtilisateur"]; }?>" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="text" name="Nom" class="form-control" placeholder="Nom" value="<?php if(isset($_COOKIE["nomUtilisateur"])) { echo $_COOKIE["nomUtilisateur"]; }?>" required="required" autocomplete="off">
        </div>

        <div class="form-group">
            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" value="<?php if(isset($_COOKIE["pseudonyme"])) { echo $_COOKIE["pseudonyme"]; }?>" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Inscription</button>
        </div>
    </form>
</div>
</body>
</html>