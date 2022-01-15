<div id="debut" class="container py-5 bg-light" style="margin-top: 150px;">
    <?php
    if ($lesRecettesUtilisateurs != null) { ?>
        <h2 class="display-6 text-center mb-5">Voici vos Recettes</h2>
        <div class="row">
            <?php
            foreach ($lesRecettesUtilisateurs as $key => $value) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-4 shadow-sm">
                        <img src="view/image/<?php echo $lesRecettesUtilisateurs[$key]['imageRecette']; ?>" class="w-100">
                        <div class="card-body">
                            <p class="card-title">
                            <h3><?php echo $lesRecettesUtilisateurs[$key]['nomRecette']; ?></h3>
                            </p>
                            <div class="btn-group">
                                <button onclick="window.location.href='routeur.php?action=afficherRecette&numRecette=<?php echo $lesRecettesUtilisateurs[$key]['numRecette']; ?>'" type="button" class="btn btn-sm btn-outline-secondary ml-1">
                                    Découvrir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    <?php } else {
    ?>
        <h2 class="display-6 text-center mb-5">Désolé, vous n'avez pas de recettes pour le moment...</h2>
    <?php }
    ?>
</div>