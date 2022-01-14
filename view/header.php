<?php
session_start();
$nomPage = "Le quartier des plaisirs";
if (isset($_GET["numRecette"])) {
    $numRecette = ($_GET['numRecette']);
    $ArrayNomRecette = Recette::getNomRecettebyNumRecette($numRecette);
    $nomRecette = $ArrayNomRecette['nomRecette'];
    $nomPage = "Recette de " . $nomRecette;
    $ArrayDiffRecette = Recette::getDifficultebyNumRecette($numRecette);
    $difficulteRecette = $ArrayDiffRecette['difficulteRecette'];
    $ArrayInstruction = Recette::getInstructionbyNumRecette($numRecette);
    $instructionRecette = $ArrayInstruction['descriptionRecette'];
}
?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="view/image/icon.png" type="image/icon type">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="view/css/style.css" />
    <link rel="stylesheet" type="text/css" href="view/css/login-register.css" />
    <title><?php echo $nomPage; ?></title>
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-xl navbar-dark" id="navbarHeader">
            <div class="container-md" id="containerHeader">
                <a href="routeur.php" class="navbar-brand mb-0 h1">
                    <img class="d-inline-block" src="view/image/icon.png" width="80" height="80" />
                    Le quartier des plaisirs
                </a>
                <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <button onclick="window.location.href='routeur.php?action=create'" type="button" class="btn btn-sm btn-outline-primary ml-1">
                            Ajouter une recette
                        </button>
                    <?php } else { ?>
                        <a href="#debut" class="btn btn-outline-light my-2 mr-3 my-lg-0">Voir les recettes</a>
                    <?php } ?>
                    <?php if (isset(($_SESSION['Admin']))) {
                        if ($_SESSION['Admin'] == 1) { ?>
                            <button onclick="window.location.href='routeur.php?action=ajoutMod'" type="button" class="btn btn-primary ml-2">
                                Ajouter un modérateur
                            </button>
                        <?php } ?>
                    <?php } ?>
                    <ul class="navbar-nav ml-auto">
                        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="routeur.php" method="get">
                            <input type="hidden" name="action" value="rechercher">
                            <input type="search" class="form-control form-control-dark" placeholder="Rechercher..." aria-label="Search" name="inputClient">
                        </form>
                        <?php if (isset($_SESSION['user'])) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navBarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">Mon Compte</a>
                                <ul class="dropdown-menu" aria-labelledby="navBarDropdown">
                                    <li>
                                        <a href="routeur.php?action=deconnexion" class="dropdown-item">Déconnexion</a>
                                    </li>
                                    <li>
                                        <a href="routeur.php?action=afficherRecetteUtilisateur" class="dropdown-item">Mes recettes</a>
                                    </li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <button onclick="window.location.href='routeur.php?action=seConnecter'" type="button" class="btn btn-outline-light my-2 mr-3 my-lg-0">Connexion</button>
                            <button onclick="window.location.href='routeur.php?action=inscription'" type="button" class="btn btn-warning my-2 my-lg-0">Inscription</button>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </header>