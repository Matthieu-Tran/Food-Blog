<div id="card">
    <div class="card w-75 mx-auto">
        <img
                src="view/image/<?php echo $numRecette?>.png"
                class="card-img-top rounded mx-auto d-block max-width: 50%;"
        />
        <div class="card-body">
            <h5 class="card-title"><?php echo $nomRecette?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Difficulté recette: <?php echo $difficulteRecette?></h6>
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
                            if($nbIngredientRecette>0){
                                for ($i =0; $i<$nbIngredientRecette; $i++){?>
                            <li class="list-group-item">
                                <?php echo $listeIngredient[$i]['nomIngredient'];?>
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
                        foreach($listeNomUstensile as $key=>$value){?>
                            <li class="list-group-item"><?php echo $listeNomUstensile[$key];?></li>
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

            <div class="container">
                <h1 class="mt-5 mb-5">Commentaires</h1>
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <h1 class="text-warning mt-4 mb-4">
                                    <b><span id="average_rating">0.0</span> / 5</b>
                                </h1>
                                <h3> 0 Avis</h3>
                            </div>
                            <div class="col-sm-4">
                                <p>
                                <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <h3 class="mt-4 mb-3">Write Review Here</h3>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#review_modal">
                                    Review
                                </button>
                            </div>
                        </div>
                <div class="mt-5" id="review_content"></div>
            </div>

            <div id="review_modal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Submit Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Note</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                            </div>
                            <div class="form-group text-center mt-4">
                                <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>