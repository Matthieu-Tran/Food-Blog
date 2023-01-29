<div id="debut" class="container py-5 bg-light" style="margin-top: 150px; margin-bottom: 700px;">
    <?php
    if ($lesRecettes != null) { ?>
        <h2 class="display-6 text-center mb-5">Voici des résulats selon votre recherche</h2>
        <div class="row">
            <?php
            foreach ($lesRecettes as $key => $value) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-4 shadow-sm">
                        <img src="view/image/<?php echo $lesRecettes[$key]['imageRecette']; ?>" class="w-100 align" alt="photo">
                        <div class="card-body">
                            <h3 class="card-title" ><?php echo $lesRecettes[$key]['nomRecette']; ?></h3>
                            <div class="btn-group">
                                <button onclick="window.location.href='index.php?action=afficherRecette&numRecette=<?php echo $lesRecettes[$key]['numRecette']; ?>'" type="button" class="btn btn-sm btn-outline-secondary ml-1">
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
        <h2 class="display-6 text-center mb-5">Désolé, il n'y a aucun résultats...</h2>
    <?php }
    ?>
</div>