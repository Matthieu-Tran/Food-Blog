    <div class="login-form" style="min-height: 80vh; margin-top: 200px;">
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
                    break;

                case 'prenom_length':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Votre prénom est trop long..
                    </div>
                    <?php
                    break;

                case 'nom_length':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Votre nom est trop long..
                    </div>
                    <?php
                    break;

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
        <p class="text-center">Vous avez déja un compte ?</p>
        <p class="text-center"><a href="routeur.php?action=seConnecter">Connectez vous</a></p>
    </div>
