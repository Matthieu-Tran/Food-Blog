    <div class="login-form" style="min-height: 80vh; margin-top: 200px;">
        <?php
        if(isset($_GET['login_err']))
        {
            $err = htmlspecialchars($_GET['login_err']);

            switch($err)
            {
                case 'password':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Mot de passe incorrect !
                    </div>
                    <?php
                    break;

                case 'Pseudo':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Pseudo incorrect !
                    </div>
                    <?php
                    break;
            }
        }
        ?>
        <form action="index.php?action=connection_traitement" method="post">
            <h2 class="text-center">Connexion</h2>
            <div class="form-group">
                <input type="text" name="Pseudo" class="form-control" placeholder="Pseudo" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } else if (isset($_COOKIE["mdpDif"])) { echo $_COOKIE["mdpDif"]; } ?>" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
            </div>
            <div class="form-check mb-3">
                <div>
                    <input type="checkbox" name="rememberme" value="1" <?php if(isset($_COOKIE["username"])) { ?> checked <?php }  ?> />&nbsp;Remember username
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Connexion</button>
            </div>
        </form>
        <p class="text-center"><a href="index.php?action=inscription">Inscription</a></p>
    </div>
