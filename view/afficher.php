<div id="card" style="padding-top: 150px">
    <div class="card w-75 mx-auto">
        <div class="text-center">
            <?php if ($recetteExistante) { ?>
                <div class="alert alert-primary" role="alert">
                    Recette déjà existante !
                </div>
            <?php } ?>
            <img src="view/image/<?php echo $nomRecetteImage ?>" class="reduire" />
        </div>
        <div class="card-body">
            <?php
                if ((($tabNomRecette['numUtilisateur']) == $_SESSION['numUtilisateur']) || isset($_SESSION['Admin']) || isset($_SESSION['Moderateur'])) { ?>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#verification_modal" style="margin-bottom: 10px">
                        Supprimer Recette
                    </button>
                <?php } ?>
            <h5 class="card-title"><?php echo $nomRecette ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Difficulté recette: <?php echo $difficulteRecette ?></h6>
            <ul class="nav nav-tabs nav-justified mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-outline-primary active" id="ingredient-tab" data-bs-toggle="pill" data-bs-target="#tabs-ingredient" type="button" role="tab" aria-controls="tabs-ingredient" aria-selected="true">Ingrédients</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn btn-outline-primary" id="ustensile-tab" data-bs-toggle="pill" data-bs-target="#tabs-ustensile" type="button" role="tab" aria-controls="tabs-ustensile" aria-selected="false">Ustensiles</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn btn-outline-primary" id="instruction-tab" data-bs-toggle="pill" data-bs-target="#tabs-instruction" type="button" role="tab" aria-controls="tabs-instruction" aria-selected="false">Instructions</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="tabs-ingredient" role="tabpanel" aria-labelledby="ingredient-tab">
                    <ul class="list-group">
                        <?php
                        if ($nbIngredientRecette > 0) {
                            for ($i = 0; $i < $nbIngredientRecette; $i++) { ?>
                                <li class="list-group-item">
                                    <?php echo $listeIngredient[$i]['nomIngredient']; ?>
                                    <span class="badge badge-primary badge-pill"><?php echo $listeQuantite[$i]['quantite']; ?></span>
                                </li>
                        <?php
                            }
                        } ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="tabs-ustensile" role="tabpanel" aria-labelledby="ustensile-tab">
                    <ul class="list-group">
                        <?php
                        foreach ($listeNomUstensile as $key => $value) { ?>
                            <li class="list-group-item"><?php echo $listeNomUstensile[$key]; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="tabs-instruction" role="tabpanel" aria-labelledby="instruction-tab">
                    <?php
                    echo "<pre>";
                    echo $instructionRecette;
                    echo "</pre>";
                    ?>
                </div>
            </div>
            <?php if (!$existeCommentaire) { ?>
            <?php } else { ?>
                <div class="container">
                    <h1 class="mt-5 mb-5">Commentaires</h1>
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <h1 class="text-warning mt-4 mb-4">
                                <b><span id="average_rating"><?php if ($moyenneCommentaire > 0) echo round($moyenneCommentaire, 2);
                                                                else echo 0; ?> </span> / 5</b>
                            </h1>
                            <h3> <?php if ($nbCommentaires > 0) echo $nbCommentaires;
                                    else echo "0"; ?> Avis</h3>
                        </div>
                        <div class="col-sm-4">
                            <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span><?php if ($nb5) echo $nb5;
                                                                        else echo 0; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $pourcentage5 ?>%"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span><?php if ($nb4) echo $nb4;
                                                                        else echo 0; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $pourcentage4 ?>%"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span><?php if ($nb3) echo $nb3;
                                                                        else echo 0; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $pourcentage3 ?>%"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span><?php if ($nb2) echo $nb2;
                                                                        else echo 0; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $pourcentage2 ?>%"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span><?php if ($nb1) echo $nb1;
                                                                        else echo 0; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $pourcentage1 ?>%"></div>
                            </div>
                            </p>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <?php if (!$existeCommentaire) { ?>
                            <div class="text-center">
                                <h3 class="mt-4 mb-3">Donnez votre avis</h3>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#review_modal">
                                    Review
                                </button>
                                <hr>
                                <div class="alert alert-primary" role="alert">
                                    Il n'y a pas encore de commentaire pour cette recette
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-sm-4 text-center">
                                <h3 class="mt-4 mb-3">Write Review Here</h3>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#review_modal">
                                    Review
                                </button>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-sm-4 text-center">
                            <h5 class="mt-4 mb-3">Veuillez vous connecter pour mettre un commentaire</h5>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="mt-5" id="review_content">
                        <?php
                        if (isset($_GET['com_warning'])) { ?>
                            <div class="alert alert-danger">
                                <strong>ATTENTION</strong> Votre commentaire n'est pas conforme, vous avez reçu un avertissement, au bout de 3, votre compte sera banni et toutes vos recettes seront supprimées
                            </div>
                        <?php }
                        ?>
                        <?php if (!$existeCommentaire) { ?>
                            <?php } else {
                            foreach ($commentaires as $key => $val) {
                                $pseudo = Utilisateur::getPseudoUtilisateurbyNumUtilisateur($commentaires[$key]['numUtilisateur']);
                                $numUtilisateur = $_SESSION['numUtilisateur'];
                            ?>
                                <div class="row mb-3">
                                    <div class="col-sm-11">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="float-left">
                                                    <b> <?php echo $pseudo['pseudoUtilisateur'] ?> </b>
                                                </div>
                                                <div class="float-right">
                                                    <?php if ((($tabNomRecette['numUtilisateur']) == $_SESSION['numUtilisateur']) || isset($_SESSION['Admin']) || isset($_SESSION['Moderateur'])) { ?>
                                                        <button onclick="window.location.href='routeur.php?action=supprimerCommentaire&numCommentaire=<?php echo $commentaires[$key]['numCommentaire']; ?>&numRecette=<?php echo $numRecette; ?>'" type="button" class="btn btn-sm btn-outline-secondary ml-1">
                                                            Supprimer
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <i><?php echo $commentaires[$key]['descriptionCommentaire'];  ?></i>
                                            </div>
                                            <div class="card-footer">
                                                <div class="float-left">
                                                    <?php
                                                    $note = $commentaires[$key]['noteCommentaire'];
                                                    for ($i = 0; $i < $note; $i++) {
                                                        echo "<span class='fa fa-star' style='color: orange'></span>";
                                                    }
                                                    for ($i = 0; $i < 5 - $note; $i++) {
                                                        echo "<span class='fa fa-star'></span>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="float-right">
                                                    <?php echo $commentaires[$key]['dateCommentaire'];  ?>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Submit Review</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="routeur.php" method="get">
                                        <input type='hidden' name='action' value='ajoutCommentaire'>
                                        <input type='hidden' name='numRecette' value='<?php echo $numRecette ?>'>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Note</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="user_rating">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here" required="required"></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" tabindex="-1" role="dialog" id="verification_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Attention !</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Voulez vous vraiment supprimer votre recette ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="window.location.href='routeur.php?action=supprimerRecette&numRecette=<?php echo $numRecette ?>'" class="btn btn-primary">Oui</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Non</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>