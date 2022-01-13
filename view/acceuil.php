    <section class="accueil bg-dark d-flex w-100 h-100 flex-column justify-content-center align-items-center">

        <h1 class="display-1 text-white text-center">Faîtes vous plaisir</h1>
        <p class="lead text-center text-white">Découvrez les recettes de nos membres et partagez nous vos plus belles recettes</p>
        <p class="lead mb-1">
            <a href="#debut" class="btn btn-lg btn-secondary">En savoir plus</a>
        </p>

    </section>
    <?php
    if (isset($_GET['ban'])) { ?>
        <div class="alert alert-danger">
            <strong>ATTENTION</strong> Votre compte viens d'être banni pour commentaires abusifs
        </div>
    <?php }
    ?>

    <!-- Grille Responsive -->
    <div id="debut" class="container py-5 bg-light">

        <h2 class="display-6 text-center mb-5">Commencez à vous régalez</h2>
        <!-- 576 XS - > 576px S > 768px M > 992px L > 1200px Extra Large-->
        <div class="row">
            <?php
            foreach ($lesRecettes as $key => $value) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-4 shadow-sm">
                        <img src="view/image/<?php echo $lesRecettes[$key]['imageRecette']; ?>" class="w-100 align">
                        <div class="card-body">
                            <p class="card-title">
                            <h3><?php echo $lesRecettes[$key]['nomRecette']; ?></h3>
                            </p>
                            <div class="btn-group">
                                <button onclick="window.location.href='routeur.php?action=afficherRecette&numRecette=<?php echo $lesRecettes[$key]['numRecette']; ?>'" type="button" class="btn btn-sm btn-outline-secondary ml-1">
                                    Découvrir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>