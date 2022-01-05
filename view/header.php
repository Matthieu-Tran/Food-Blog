<?php
    session_start();
?>

<!doctype html>
<html lang="fr">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="view/css/headerStylesheet.css"/>
      <title>Le quartier des plaisirs</title>
    </head>
    <body>
        <header>
          <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color:#ffb142;">
            <div class="container">
                <a href="routeur.php"
                   class="navbar-brand mb-0 h1">
                  Le quartier des plaisirs
                </a>
                <button
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        class="navbar-toggler"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                >
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse"
                     id ="navbarNav">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <button onclick="window.location.href=#" type="button" class="btn btn-outline-light my-2 mr-3 my-lg-0">Déposer une recette</button>
                    <?php } else { ?>
                        <button onclick="window.location.href=#" type="button" class="btn btn-outline-light my-2 mr-3 my-lg-0">Voir les recettes</button>
                    <?php } ?>
                  <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a href="#" class="nav-link active">
                        Recettes
                      </a>
                    </li>
                    <li class="nav-item active">
                      <a href="#" class="nav-link active">
                        Pricing
                      </a>
                    </li>
                  </ul>
                  <ul class="navbar-nav ml-auto">
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                      <input type="search" class="form-control form-control-dark" placeholder="Rechercher..." aria-label="Search">
                    </form>
                      <?php if (isset($_SESSION['user'])) { ?>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" id ="navBarDropdown" role ="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">Mon Compte</a>
                              <ul class="dropdown-menu" aria-labelledby="navBarDropdown">
                                  <li>
                                      <a href="routeur.php?action=deconnexion" class="dropdown-item">Déconnexion</a>
                                  </li>
                                  <li>
                                      <a href="#" class="dropdown-item">Mes recettes</a>
                                  </li>
                              </ul>
                          </li>
                      <?php } else { ?>
                          <button onclick="window.location.href='routeur.php?action=seConnecter'" type="button" class="btn btn-outline-light my-2 mr-3 my-lg-0">Connexion</button>
                          <button onclick="window.location.href='routeur.php?action=inscription'" type="button" class="btn btn-warning my-2 my-lg-0" >Inscription</button>
                      <?php } ?>

                  </ul>
                </div>
            </div>
          </nav>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        </header>