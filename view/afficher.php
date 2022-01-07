<div id="card">
    <div class="card mx-auto" style="width: 70rem;">
        <img
                src="view/image/<?php echo $numRecette?>"
                class="card-img-top"
        />
        <div class="card-body">
            <h5 class="card-title"><?php echo $nomRecette?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Difficulté recette: <?php echo $difficulteRecette?></h6>
            <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the
                card's content.
            </p>

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
                            <li class="list-group-item d-flex justify-content-between align-items-center ">
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


        </div>
    </div>
</div>